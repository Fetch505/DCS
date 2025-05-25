<?php

namespace App\Http\Controllers\APIs;

use Auth;
use JWTAuth;
use App\Models\User;
use App\Models\Day;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Resources\PrivateUserResource;

class AuthController extends Controller
{
    public function __construct()
    {
        // Apply JWT middleware except for public actions
        $this->middleware('JWT', ['except' => ['login', 'register', 'refresh', 'me', 'updatepassword']]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => "Not registered user",
            ], 404);
        }

        if (in_array($user->role->name, ['admin', 'superadmin'])) {
            return response()->json([
                'status' => false,
                'message' => "This user is not allowed to login",
            ], 403);
        }

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Update device info and login status
        $user->device_unique_id = $request->device_unique_id;
        $user->fcm_token = $request->fcm_token;
        $user->device_type = $request->device_type;
        $user->loggedIn = true;
        $user->lastLoggedIn = now();
        $user->save();

        $unreadNotificationCount = Notification::where('reciever_id', $user->id)->where('status', 0)->count();

        return (new PrivateUserResource($user))->additional([
            'meta' => [
                'unreadNotificationCount' => $unreadNotificationCount,
                'expires_in' => JWTAuth::factory()->getTTL() * 60,
                'token' => $token,
            ]
        ]);
    }

    public function register(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->company_id = 398; // demo company
        $user->role_id = 3; // worker role id
        $user->slug = Str::slug($request->name) . '-' . time();
        $user->password = Hash::make($request->password);
        $user->worker_type_id = 1;
        $user->reports_to_id = 400;
        $user->allow_leaves = false;
        $user->device_unique_id = $request->device_unique_id;
        $user->country = 'Netherlands';
        $user->device_type = $request->device_type;
        $user->save();

        // Assign demo tasks
        foreach ([429, 434] as $taskId) {
            $task = Day::find($taskId);
            if ($task) {
                $task->user_id = $user->id;
                $task->save();
            }
        }

        $message = ($request->header('Accept-Language') == 'en') ? 'Company created successfully' : 'Bedrijf succesvol opgericht';

        return response()->json([
            'status' => true,
            'message' => $message,
        ]);
    }

    public function updatepassword(Request $request)
    {
        $userId = $request->id;
        $password = $request->password;

        $user = User::find($userId);

        if (!$user) {
            return response()->json(['status' => false, 'message' => 'User not found'], 404);
        }

        $user->password = Hash::make($password);
        $user->last_update_by = Auth::id();
        $user->save();

        $message = ($request->header('Accept-Language') == 'en') ? 'Password Updated Successfully' : 'Wachtwoord succesvol bijgewerkt';

        return response()->json([
            'status' => true,
            'message' => $message,
        ]);
    }

    public function me(Request $request)
    {
        return new PrivateUserResource($request->user());
    }

    public function logout()
    {
        try {
            $user = Auth::user();
            if ($user) {
                $user->device_unique_id = '';
                $user->fcm_token = '';
                $user->device_type = '';
                $user->loggedIn = false;
                $user->save();
            }

            JWTAuth::invalidate(JWTAuth::getToken());

            return response()->json(['message' => 'Successfully logged out']);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['error' => 'Failed to logout, token invalid'], 401);
        }
    }

    public function refresh()
    {
        try {
            $token = JWTAuth::refresh();
            return $this->respondWithToken($token);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['error' => 'Token refresh failed'], 401);
        }
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60
        ]);
    }
}

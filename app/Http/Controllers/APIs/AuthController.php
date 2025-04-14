<?php

namespace App\Http\Controllers\APIs;
use Auth;
use JWTAuth;
use App\Models\User;
use App\Models\Project;
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
        // $this->middleware('auth:api', ['except' => ['login']]);
        $this->middleware('JWT', ['except' => ['login','signup']]);
    }

    public function login(Request $request)
    {
        $device_unique_id = $request->device_unique_id;
        $fcm_token        = $request->fcm_token;
        $device_type      = $request->device_type;

        $user = User::where('email','=',$request->email)->first();
        if (! isset($user->id)) {
            return response()->json([
                'status' => false,
                'message' => "Not registered user",
            ]);
        }
        else if($user->role->name == 'admin' || $user->role->name == 'superadmin'){
            return response()->json([
                'status' => false,
                'message' => "This user not allowed to login",
            ]);
        }else {
        $user->device_unique_id = $device_unique_id;
        $user->fcm_token        = $fcm_token;
        $user->device_type      = $device_type;
        $user->loggedIn         = true;
        $user->lastLoggedIn     = now();
        $user->save();

        $credentials = request(['email', 'password']);

        if (! $token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $my_id = Auth::user()->id;
        $unreadMSG_Count = Notification::where('reciever_id','=',$my_id)
                        ->where('status','=',0)->count();

        return (new PrivateUserResource($request->user()))
        ->additional([
          'meta' => [
              'unreadNotificationCount' => $unreadMSG_Count,
            // 'expiresIn' => auth()->factory()->getTTL() * 60,
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'token' => $token
          ]
        ]);
      }//else
    }

    public function register(Request $request)
    {

      $device_unique_id = $request->device_unique_id;
      $device_type      = $request->device_type;

      //create new worker for the demo company
      $user = new User;
      $user->name = $request->name;
      $user->email = $request->email;
      $user->company_id = 398;
      $user->role_id = 3;
      $user->slug = Str::slug($request->name) . '-' . time();
      $user->password =  Hash::make($request->password);
      $user->worker_type_id = 1;
      $user->reports_to_id = 400;
      $user->allow_leaves = false;
      $user->device_unique_id = $device_unique_id;
      $user->country        =  'Netherlands';
      $user->device_type      = $device_type;
      $user->save();

      //assign the user to the demo weekly task
      $day = Day::find(429);
      $day->user_id = $user->id;
      $day->save();

      //assign the user to the demo daily task
      $day = Day::find(434);
      $day->user_id = $user->id;
      $day->save();


      $message = ($request->header == 'en')? 'company created successfully' : 'bedrijf succesvol opgericht';

      return response()->json([
        'status' => true,
        'message' => $message,
      ]);

    }
    public function updatepassword(Request $request)
    {
      $id = Auth::user()->id;
      $user_id = $request->id;
      $password = $request->password;
      $user = User::find($user_id);
      $user->password =  Hash::make($password);
      $user->last_update_by = $id;

      $user->save();
      $message = ($request->header == 'en')? 'Password Updated Successfully' : 'Wachtwoord succesvol bijgewerkt';

      return response()->json([
        'status' => true,
        'message' => $message,
      ]);

    }

    public function me(Request $request)
    {
        // return response()->json(auth()->user());
        return (new PrivateUserResource($request->user()));
    }

    public function logout()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $user->device_unique_id = '';
        $user->fcm_token        = '';
        $user->device_type      = '';
        $user->loggedIn         = false;
        $user->save();

        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            // 'expires_in' => auth()->factory()->getTTL() * 60
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

}

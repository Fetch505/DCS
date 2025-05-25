<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
{
    if (($user->hasRole('superadmin') || $user->hasRole('admin') || $user->hasRole('customer')) && $user->is_active == 1) {
        $user->lastLoggedIn = now();
        $user->save();

        // Redirect to external URL instead of /home
        return redirect()->away('https://digital-clean-solution.vercel.app/');
    } else {
        Auth::logout();
        return redirect()->back()->withErrors([
            'email' => 'Unauthorized access.',
        ]);
    }
}
}

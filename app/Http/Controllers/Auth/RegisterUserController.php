<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterNewUserRequest;

class RegisterUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(RegisterNewUserRequest $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = 2;
        $user->slug = Str::slug($request->name) . '-' . time();
        $user->password =  Hash::make($request->password);
        $user->allow_leaves = true;
        $user->language = $request->language;
        $user->save();

        $this->guard()->login($user);

        return redirect('/home');
    }


    protected function guard()
    {
        return Auth::guard();
    }

}

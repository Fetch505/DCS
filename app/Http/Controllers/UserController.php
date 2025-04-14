<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    // Method to handle deleting users
    public function deleteUser(Request $request)
    {
        return "<h1>Delete users</h1>";
    }

    // Method for displaying a simple greeting
    public function greetPakistan(Request $request)
    {
        return "<h1>Hello Pakistan</h1>";
    }
}

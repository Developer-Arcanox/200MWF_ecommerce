<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function index()
    {
        Auth::logout();

        return view("welcome");
    }

    function showRegisterForm()
    {
        return view("register");
    }

    function register(Request $request)
    {
        User::create([
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "email" => $request->email,
            "phone" => $request->phone,
            "password" => Hash::make($request->password)
        ]);

        return redirect("/login")->with("success", "Account created successfully");
    }

    function showLoginForm()
    {
        return view("login");
    }

    function login(Request $request)
    {
        if (Auth::attempt(["email" => $request->email, "password" => $request->password])) {
            return redirect()->route("user.dashboard");
        } else {
            return redirect()->route("login.page");
        }
    }

    function userDashboard()
    {
        return view("user.dashboard");
    }

    function adminDashboard()
    {
        return view("admin.dashboard");
    }

    function unauthorised()
    {
        return view("unauthorised");
    }
}

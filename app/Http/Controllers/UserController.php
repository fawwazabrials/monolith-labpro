<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;

class UserController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth')->except(['login', 'postLogin', 'register']);
    // }

    // show login page
    public function login() {
        return view("users.login");
    }

    // login logic
    public function postLogin() {
        $credentials = request()->validate([
            "email" => ["required", "email"],
            "password" => "required"
        ]);

        if (!$token = auth()->attempt($credentials)) {
            return back()->withErrors(['invalid' => 'Wrong email or password'])->onlyInput("email");
        }

        return redirect(route("home"))->withCookie("jwt_token", $token, auth()->factory()->getTTL() * 60, "/")->with("success", "User logged in successfully");
    }

    // show register page
    public function logout() {
        auth()->logout();
        Cookie::forget("jwt_token");

        return redirect(route("home"))->with("danger", "User logged out successfully");
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;

class UserController extends Controller
{


    // show login page
    public function login() {
        return view("users.login");
    }

    // login logic
    public function authenticate() {
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

    public function register() {
        return view("users.register");
    }

    public function store() {
        $credentials = request()->validate([
            "first_name" => ['required', 'min:3'],
            "last_name" => ['required', 'min:3'],
            "username" => ['required', 'min:3', Rule::unique('users', 'username')],
            "email" => ['required', 'email', Rule::unique('users', 'email')],
            "password" => "required|confirmed|min:6"
        ]);
        $credentials["password"] = bcrypt($credentials["password"]);
        // dd($credentials);

        $user = User::create($credentials);


        $token = auth()->login($user);

        return redirect(route("home"))->withCookie("jwt_token", $token, auth()->factory()->getTTL() * 60, "/")->with("success", "User logged in successfully");
    }
}

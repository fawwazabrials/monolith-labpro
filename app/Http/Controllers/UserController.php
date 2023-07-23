<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
    public function postLogin() {
        $credentials = request()->validate([
            "email" => ["required", "email"],
            "password" => "required"
        ]);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // dd($token);

        // $request = Request::create('/api/auth/login', 'POST', $credentials);
        // $response = Route::dispatch($request);

        // // $cookieRes = Cookie::get();
        // // dd($cookieRes);

        // dd($response);

        return redirect("/")->withCookie("jwt_token", $token, auth()->factory()->getTTL() * 60, "/");
    }
}

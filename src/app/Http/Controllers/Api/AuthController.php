<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function authenticate()
    {
        $credentials = request()->validate([
            "email" => ["required", "email"],
            "password" => "required"
        ]);

        if (!$token = auth()->attempt($credentials)) {
            return response()
                ->json([
                    "status" => "error",
                    "message" => "Invalid credentials"
                ], 401);
        }

        return response()->json([
            "status" => "success",
            "message" => "User logged in successfuly",
            "data" => auth()->user(),
            "token" => $token
        ], 200)->withCookie("jwt_token", $token, auth()->factory()->getTTL() * 60, "/");
    }

    public function store()
    {
        $credentials = request()->validate([
            "first_name" => ['required', 'min:3'],
            "last_name" => ['required', 'min:3'],
            "username" => ['required', 'min:3', Rule::unique('users', 'username')],
            "email" => ['required', 'email', Rule::unique('users', 'email')],
            "password" => "required|min:6"
        ]);

        $user = User::create($credentials);
        $token = auth()->login($user);

        return response()->json([
            "status" => "success",
            "message" => "User created successfuly",
            "data" => $user,
            "token" => $token
        ])->withCookie("jwt_token", $token, auth()->factory()->getTTL() * 60, "/");
    }

    public function show()
    {
        return response()->json([
            "status" => "success",
            "message" => "User info fetched successfuly",
            "data" => auth()->user()
        ], 200);
    }

    public function logout()
    {
        auth()->logout();
        Cookie::forget("jwt_token");

        return response()->json([
            "status" => "success",
            "message" => "User logged out successfuly"
        ], 200);
    }
}

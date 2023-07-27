<?php

use App\Http\Controllers\Api\ListingController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/listing', [ListingController::class, "index"]);
Route::get('/listing/{id}', [ListingController::class, "show"]);
Route::post('/auth/login', [AuthController::class, "authenticate"]);
Route::post('/auth/register', [AuthController::class, "store"]);
Route::post('/auth/logout', [AuthController::class, "logout"])->middleware("authapi");
Route::post('/auth/me', [AuthController::class, "show"])->middleware("authapi");
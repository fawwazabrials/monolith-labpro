<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Show all listings
Route::get('/', [ListingController::class, "index"]);

// Show singular listing
Route::get('/listing/{id}', [ListingController::class, "show"]);

// Show log in page
Route::get('/login', [UserController::class, "login"]);

// logs in user
Route::post('/auth/login', [UserController::class, "postLogin"]);

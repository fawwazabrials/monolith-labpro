<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\TransactionController;
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
Route::get('/', [ListingController::class, "index"])->name("home");

// Show singular listing
Route::get('/listing/{id}', [ListingController::class, "show"])->name("item-page");

// Show log in page
Route::get('/login', [UserController::class, "login"])->name("login")->middleware("guest");

// logs in user
Route::post('/auth/login', [UserController::class, "authenticate"])->middleware("guest");

// logs out user
Route::post('/logout', [UserController::class, "logout"])->name("logout");

// show register page
Route::get('/register', [UserController::class, "register"])->name("register")->middleware("guest");

// registers a user
Route::post('/auth/register', [UserController::class, "store"])->middleware("guest");

// show transaction history of user
Route::get('/history', [TransactionController::class, "index"])->name("history")->middleware("auth");

Route::post('/buy', [ListingController::class, "buy"])->middleware("auth");
<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\SellersController;
use App\Http\Controllers\UsersSignInController;
use App\Http\Controllers\UsersSignUpController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::post('/signin', [UsersSignInController::class, 'sign_in']);
Route::post('/signup', [UsersSignUpController::class, 'sign_up']);
Route::post('/register', [AuthController::class, 'register']); // JWT successful attempt
Route::post('/login', [AuthController::class, 'login']); // JWT failed attempt

Route::post('/create', [SellersController::class, 'create_product']);
Route::post('/update', [SellersController::class, 'update_product']);
Route::post('/delete', [SellersController::class, 'delete_product']);
Route::post('/read', [SellersController::class, 'read_my_products']); // this is post to not show user_id in url
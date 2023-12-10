<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\UsersSignInController;
use App\Http\Controllers\UsersSignUpController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/signin', [UsersSignInController::class, 'sign_in']);
Route::post('/signup', [UsersSignUpController::class, 'sign_up']);
Route::post('/register', [AuthController::class, 'register']); // JWT attemp
Route::post('/login', [AuthController::class, 'login']); // JWT attempt


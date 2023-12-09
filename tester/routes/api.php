<?php

use App\Http\Controllers\UsersSignInController;
use App\Http\Controllers\UsersSignUpController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/signin', [UsersSignInController::class, 'sign_in']);
Route::post('/signup', [UsersSignUpController::class, 'sign_up']);
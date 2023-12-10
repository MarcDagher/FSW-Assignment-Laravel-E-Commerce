<?php
use App\Http\Controllers\Api\Auth\AuthController; // JWT
use App\Http\Controllers\UsersController;
use App\Http\Controllers\KartController;
use App\Http\Controllers\SellersController;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::post('/signin', [UsersController::class, 'sign_in']);
Route::post('/signup', [UsersController::class, 'sign_up']);


Route::post('/register', [AuthController::class, 'register']); // JWT successful attempt
Route::post('/login', [AuthController::class, 'login']); // JWT failed attempt

Route::post('/create', [SellersController::class, 'create_product']);
Route::post('/update', [SellersController::class, 'update_product']);
Route::post('/delete', [SellersController::class, 'delete_product']);
Route::post('/read', [SellersController::class, 'read_my_products']); // this is post to not show user_id in url

Route::get('/displaykart', [KartController::class, 'display_products']);
Route::post('/addtokart', [KartController::class, 'add_to_kart']);
Route::post('/removefromkart', [KartController::class, 'remove_from_kart']);


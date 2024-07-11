<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::group(['middleware' => 'jwt'], function () {

    Route::post('/whoami', [AuthController::class, 'whoami']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::post('/users', [UserController::class, 'users']);
    Route::post('/user', [UserController::class, 'user']);
    Route::post('/connect', [UserController::class, 'connect']);

    Route::post('/send', [MessageController::class, 'send']);
});

Route::post('/broadcasting/auth', function (Request $request) {
    return Broadcast::auth($request);
});

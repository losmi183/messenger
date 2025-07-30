<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ConnetcionController;

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



Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/logout', [AuthController::class, 'logout']);

Route::group(['middleware' => 'jwt', 'prefix' => 'auth'], function () {
    Route::post('/whoami', [AuthController::class, 'whoami']);    
    Route::post('/send', [MessageController::class, 'send']);
});

Route::group(['middleware' => 'jwt', 'prefix' => 'user'], function () {
    Route::post('/search', [UserController::class, 'search']);
    Route::get('/show/{id}', [UserController::class, 'show']);
});

Route::group(['middleware' => 'jwt', 'prefix' => 'connection'], routes: function () {

    Route::get('/my-connections', [ConnetcionController::class, 'myConnections']);

    Route::post('/initiate', [ConnetcionController::class, 'initiate']);
    Route::post('/accept', [ConnetcionController::class, 'accept']);
    Route::post('/reject', [ConnetcionController::class, 'reject']);

    Route::post('/delete', [ConnetcionController::class, 'delete']);
});

Route::post('/broadcasting/auth', function (Request $request) {
    return Broadcast::auth($request);
});

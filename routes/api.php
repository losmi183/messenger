<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ConnetcionController;
use App\Http\Controllers\PusherAuthController;

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
Route::get('/auth/resend-verify-email', [AuthController::class, 'resendVerifyEmail']);
Route::get('/auth/verify-email', [AuthController::class, 'verifyEmail']);


Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/refresh', [AuthController::class,'refresh']);
Route::post('/auth/logout', [AuthController::class, 'logout']);
Route::post('/auth/forgot-password', [UserController::class, 'forgotPassword']);

Route::post('/auth/google-login', [AuthController::class, 'googleLogin']);
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

Route::group(['middleware' => 'jwt', 'prefix' => 'auth'], function () {
    Route::get('/whoami', [AuthController::class, 'whoami']);
});

Route::group(['middleware' => 'jwt', 'prefix' => 'user'], function () {
    Route::post('/search', [UserController::class, 'search']);
    Route::get('/show/{id}', [UserController::class, 'show']);
    Route::get('/edit', [UserController::class, 'edit']);
    Route::post('/update', [UserController::class, 'update']);
    Route::post('/change-password', [UserController::class, 'changePassword']);
});



Route::group(['middleware' => 'jwt', 'prefix' => 'connection'], routes: function () {
    Route::get('/my-connections', [ConnetcionController::class, 'myConnections']);
    Route::get('/requested', [ConnetcionController::class, 'requested']);
    Route::post('/initiate', [ConnetcionController::class, 'initiate']);
    Route::post('/accept', [ConnetcionController::class, 'accept']);
    Route::post('/reject', [ConnetcionController::class, 'reject']);
    Route::post('/delete', [ConnetcionController::class, 'delete']);
});

Route::post('/pusher/auth', [PusherAuthController::class, 'authenticate'])->middleware('jwt');
Route::group(['middleware' => 'jwt', 'prefix' => 'message'], routes: function () {
    Route::get('/my-conversations', [MessageController::class, 'myConversations']);
    Route::post('/conversation', [MessageController::class, 'conversation']);
    Route::post('/send', [MessageController::class, 'send']);
    Route::post('/seen', [MessageController::class, 'seen']);
    Route::post('/mark-as-seen', [MessageController::class, 'markAsSeen']);
});

Route::group(['middleware' => ['jwt', 'admin'], 'prefix' => 'admin'], routes: function () {
    Route::post('/users', [AdminController::class, 'users']);
});

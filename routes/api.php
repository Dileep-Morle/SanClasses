<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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
Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);
Route::post('/register', [App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('/verify-otp', [App\Http\Controllers\Api\AuthController::class, 'verifyOtp']);

Route::middleware('auth:api')->group(function(){
    Route::get('/get-user', [App\Http\Controllers\Api\AuthController::class, 'userInfo']);
});

Route::middleware('auth:sanctum')->get('/get-user', function (Request $request) {
return $request->user();
});
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ZaloraController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TransactionController;
use App\Http\Middleware\AdminCheck;
use App\Http\Middleware\UserCheck;

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

//public route 
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

//protected route
Route::middleware('auth:sanctum')->group(function () {
    
    Route::middleware([AdminCheck::class])->group(function () {
        Route::resource('zalora', ZaloraController::class, ['only' => ['show', 'store', 'update', 'destroy']]);
        Route::resource('transaction', TransactionController::class, ['only' => ['index', 'update']]);
    });
    
    Route::middleware([UserCheck::class])->group(function () {
        Route::resource('transaction', TransactionController::class)->only('store');
        Route::resource('review', ReviewController::class)->only('store', 'update', 'destroy');
    });

    Route::resource('review', ReviewController::class)->only('show', 'index', 'destroy');
    Route::resource('zalora', ZaloraController::class)->only('index');

    Route::post('logout', [AuthController::class, 'logout']);
});
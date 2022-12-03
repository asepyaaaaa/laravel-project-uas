<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ZaloraController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TransactionController;

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
    Route::resource('zalora', ZaloraController::class, ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

    
    Route::get('review', [ReviewController::class, 'index']);
    Route::get('review/{id}', [ReviewController::class, 'show']);
    Route::resource('review', ReviewController::class)->except('create', 'update', 'show', 'index', 'destroy');
    
    Route::resource('transaction', TransactionController::class)->only('store', 'index');

    Route::post('logout', [AuthController::class, 'logout']);
});
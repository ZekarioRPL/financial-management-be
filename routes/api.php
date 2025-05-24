<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Bill\BillController;
use App\Http\Controllers\Api\Category\CategoryController;
use App\Http\Controllers\Api\Transaction\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::resource('category', CategoryController::class);
Route::resource('transaction', TransactionController::class);
Route::resource('bill', BillController::class);

Route::get('/get-user', [AuthController::class, 'getUser']);
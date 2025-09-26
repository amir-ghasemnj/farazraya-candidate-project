<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoomController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

# default sanctum route
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

# auth routes
Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login'])->name('auth.login');
});

# room routes
Route::prefix('rooms')->group(function () {
    Route::get('index', [RoomController::class, 'index'])->name('room.index');
});
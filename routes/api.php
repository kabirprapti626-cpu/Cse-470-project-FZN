<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;

// Signup route
Route::post('/signup', [AuthController::class, 'signup']);

// Add car route (seller only)
Route::post('/cars', [CarController::class, 'store']);

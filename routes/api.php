<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Example methods for authentication and authentication validation
Route::post('/authenticate', [AuthController::class, 'authenticate']);
Route::get('/amiauthenticated', [AuthController::class, 'amIAuthenticated'])->middleware('auth.token');

//
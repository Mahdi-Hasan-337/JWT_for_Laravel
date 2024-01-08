<?php

use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVerificationMiddleware;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');


// Backend
Route::post('/User-Registration', [UserController::class, 'UserRegistration']);
Route::post('/User-Login', [UserController::class, 'UserLogin']);
Route::post('/Send-OTP', [UserController::class, 'SendOTP']);
Route::post('/Verify-OTP', [UserController::class, 'VerifyOTP']);
Route::post('/Reset-Password',[UserController::class,'ResetPassword'])->middleware([TokenVerificationMiddleware::class]);

// Frontend

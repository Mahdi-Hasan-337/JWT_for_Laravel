<?php

use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVerificationMiddleware;
use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home');

// Backend
Route::post('/user-registration', [UserController::class, 'UserRegistration']);
Route::post('/user-login', [UserController::class, 'UserLogin']);
Route::post('/send-otp', [UserController::class, 'SendOTP']);
Route::post('/verify-otp', [UserController::class, 'VerifyOTP']);
Route::post('/reset-password', [UserController::class, 'ResetPassword'])->middleware([TokenVerificationMiddleware::class]);

Route::get('/user-profile', [UserController::class, 'UserProfile'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/user-update', [UserController::class, 'UpdateProfile'])->middleware([TokenVerificationMiddleware::class]);

// Logout
Route::get('/logout', [UserController::class, 'UserLogout']);

// Frontend
Route::get('/userLogin', [UserController::class, 'LoginPage']);
Route::get('/userRegistration', [UserController::class, 'RegistrationPage']);
Route::get('/sendOtp', [UserController::class, 'SendOtpPage']);
Route::get('/verifyOtp', [UserController::class, 'VerifyOTPPage']);
Route::get('/resetPassword', [UserController::class, 'ResetPasswordPage'])->middleware([TokenVerificationMiddleware::class]);
Route::get('/userProfile', [UserController::class, 'ProfilePage'])->middleware([TokenVerificationMiddleware::class]);

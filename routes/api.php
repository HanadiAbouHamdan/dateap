<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ProfilepageController;
use App\Http\Controllers\UserController;

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail']);
Route::post('reset-password', [ResetPasswordController::class, 'reset']);

// storing the information from the form
Route::post('user/register', [RegistrationController::class, 'store']);

// adding a route to get the user uploaded in the profile page
Route::post('/profile/update', [ProfilepageController::class, 'update']);

//filtering the users acccording to their gender
Route::get('/registrations',[UserController::class,'index']);

//route to let the user handle the opposite gender
Route::get('/opposite-gender', [GenderController::class, 'oppositeGender']);

















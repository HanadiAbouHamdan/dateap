<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ProfilepageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GenderController;
use App\Http\Controllers\PictureController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\MessageController;



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

//Storing the picture in the picturestable:
Route::post('/pictures', [PictureController::class, 'store']);

//storing the favorite user id 
Route::post('/favorites', [FavoriteController::class, 'store']);

//deleting the favorite user 
Route::delete('/favorites/{id}', [FavoriteController::class, 'destroy']);

//adding block for a user
Route::post('/blocks', [BlockController::class, 'addBlock']);

//removing the block for the user
Route::delete('/blocks', [BlockController::class, 'removeBlock']);

//Route for sending messages
Route::post('/messages', [MessageController::class, 'sendMessage']);

//route for reading the message 
Route::get('/inbox', [MessageController::class, 'inbox']);

//route for replying on a message 
Route::post('/inbox/{message}', [MessageController::class, 'reply']);




















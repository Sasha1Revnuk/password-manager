<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->group(function(){
    Route::get('/change-password/{user}', 'UserController@changePasswordApi')->middleware(['checkUserId'])->name('changePasswordApi');
    Route::get('/change-password-secret/{user}', 'UserController@changeSecretPasswordApi')->middleware(['checkUserId'])->name('changeSecretPasswordApi');

});

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
    Route::prefix('data/{user}')->middleware(['checkUserId'])->group(function() {
        Route::prefix('webs')->group(function () {
            Route::get('/', 'WebController@getApi')->name('webs');
            Route::get('/generate-password', 'WebController@generatePasswordApi')->name('generatePasswordApi');
            Route::get('/add', 'WebController@addWebApi')->name('addWebApi');
        });
    });

});

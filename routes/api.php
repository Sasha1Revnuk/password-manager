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
            Route::get('/getSavePassword/{resource}', 'WebResourceController@getSavePassword')->middleware('checkWebResourceForUser')->name('getSavedPassword');
            Route::get('/delete/{web}', 'WebController@deleteApi')->middleware('checkWebForUser')->name('deleteWebApi');
            Route::get('/delete-resource/{resource}', 'WebResourceController@deleteResourceApi')->middleware('checkWebResourceForUser')->name('deleteWebResourceApi');
            Route::get('/add-to-quick/{web}', 'WebController@addToQuick')->middleware('checkWebForUser')->name('addToQuick');
            Route::get('/add-to-group/{web}', 'WebController@addToGroup')->middleware(['checkWebForUser'])->name('addToGroup');
            Route::get('/delete-from-group/{web}', 'WebController@deleteFromGroup')->middleware(['checkWebForUser'])->name('deleteFromGroup');
        });

        Route::prefix('groups')->group(function () {
            Route::get('/get-for-group/{group}', 'WebGroupsController@getApi')->middleware('checkWebGroupForUser')->name('getForGroup');
            Route::post('/add', 'WebGroupsController@add')->name('addGroup');
            Route::post('/edit/{group}', 'WebGroupsController@edit')->middleware('checkWebGroupForUser')->name('editGroup');
            Route::get('/get-for-web/{web}', 'WebGroupsController@get')->middleware('checkWebForUser')->name('getGroup');
            Route::get('/delete-force/{group}', 'WebGroupsController@deleteForce')->middleware('checkWebGroupForUser')->name('deleteForceGroup');
            Route::get('/un-group/{group}', 'WebGroupsController@unGroup')->middleware('checkWebGroupForUser')->name('unGroup');
        });

        Route::prefix('quick')->group(function () {
            Route::get('/', 'QuickController@getApi')->name('getQuickApi');
        });
    });

});

<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Auth::routes([
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
    ]);
Route::get('/logout', 'Auth\LoginController@logout')->name('logoutAdmin');
Route::get('/sendhtmlemail/{user}/','MailController@htmlEmail')->name('mailSender');
Route::get('/confirm/{user}/{code}','MailController@confirm')->name('mailConfirm');
Route::get('/confirm-success/','MailController@confirmSucces')->name('mailConfirmSuccess');

Route::middleware(['auth', 'adminActive'])->group(function() {

    Route::prefix('data/{user}')->middleware(['checkUserId'])->group(function() {

        Route::prefix('webs')->group(function () {
            Route::get('/', 'WebController@index')->name('webs');
            Route::get('/add-resource/{web}', 'WebResourceController@addForm')->middleware('checkWebForUser')->name('addFormResource');
            Route::post('/add-resource/{web}', 'WebResourceController@add')->middleware('checkWebForUser')->name('addResource');
            Route::get('/edit-resource-system/{resource}', 'WebResourceController@editSystemForm')->middleware('checkWebResourceForUser')->name('editSystemResourceForm');
            Route::post('/update-resource/{web}/{resource}', 'WebResourceController@update')->middleware('checkWebResourceForUser')->name('updateWebResource');
        });

        Route::prefix('groups')->group(function () {
            Route::get('/show/{group}', 'WebGroupsController@show')->name('showGroup');
        });

        Route::prefix('quick')->group(function () {
            Route::get('/', 'QuickController@index')->name('quick');
        });
    });


});


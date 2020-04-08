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
    Route::get('/quick', 'IndexController@quick')->name('quick');
});


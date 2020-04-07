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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/sendhtmlemail','MailController@htmlEmail')->name('mailSender');


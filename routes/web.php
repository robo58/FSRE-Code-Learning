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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/superadmin', function(){
    return 'you are superadmin';
})->middleware(['auth', 'auth.admin']);

Route::namespace('SuperAdmin')->prefix('superadmin')->name('superadmin.')->middleware('can:manage-users')->group(function(){
    Route::resource('/users', 'UsersController', ['except' => ['show','create','store']]);
});

Route::get('/profile', 'SuperAdmin\UsersController@profile')->name('profile');
Route::post('/profile', 'SuperAdmin\UsersController@update_profile')->name('profile');

Route::get('/password-change', 'SuperAdmin\UsersController@password_change_view')->name('password-change');
Route::post('/password-change', 'SuperAdmin\UsersController@password_update')->name('password-update');

<?php

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
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

URL::forceRootUrl('https://http://studenti.sum.ba:81/2020/g0');

Route::get('/', function (){
    return view('welcome');
});
Route::post('/', 'WelcomeController@store')->name('contact-us');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::resource('categories', 'CategoryController');
Route::resource('courses', 'CourseController');
Route::resource('courseParts', 'CoursePartController');

Route::post('/canCreate',function (){
    return response([!Gate::denies('create-posts')],200);
});

Route::get('/superadmin', function(){
    return 'you are superadmin';
})->middleware(['auth', 'auth.admin']);

Route::namespace('SuperAdmin')->prefix('superadmin')->name('superadmin.')->middleware('can:manage-users')->group(function(){
    Route::resource('/users', 'UsersController', ['except' => ['show','create','store']]);
});

Route::get('/profile/{user}', 'SuperAdmin\UsersController@profile')->name('profile');
Route::post('/profile/{user}', 'SuperAdmin\UsersController@update_profile')->name('profile');
Route::get('/teachers','SuperAdmin\UsersController@teachers')->name('teachers');
Route::get('/students','SuperAdmin\UsersController@students')->name('students');

Route::get('/getCourses/{user}','SuperAdmin\UsersController@courses');

Route::get('/password-change', 'SuperAdmin\UsersController@password_change_view')->name('password-change');
Route::post('/password-change', 'SuperAdmin\UsersController@password_update')->name('password-update');

Route::patch('/courseParts/{coursePart}/video', 'CoursePartController@updateVideo')->name('upload-video');

Route::get('/files/create', 'SuperAdmin\DocumentsController@create')->name('files-create');
Route::post('/files', 'SuperAdmin\DocumentsController@store')->name('files-upload');
Route::delete('/files/{document}', 'SuperAdmin\DocumentsController@destroy')->name('files-delete');
Route::get('/files/{part}', 'SuperAdmin\DocumentsController@get')->name('files-get');
Route::get('/files/all', 'SuperAdmin\DocumentsController@index')->name('files-show-all');
Route::get('/files/{id}', 'SuperAdmin\DocumentsController@show')->name('file-show');
Route::get('/files/download/{file}', 'SuperAdmin\DocumentsController@download');


Route::get('/inbox',function (){
    return view('inbox');
})->name('inbox');

Route::get('/inbox/{user}',function (User $user){
   return view('inbox')->withUser($user);
})->name('inbox_select');

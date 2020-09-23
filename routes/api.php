<?php

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/categories', 'CategoryController@indexJson');
Route::get('/categories/{category}/getCourses', 'CategoryController@getCourses');
Route::get('/courses', 'CourseController@indexJson');
Route::get('/courses/{course}/getProgress/{user}', 'CourseController@getProgress');
Route::get('/courses/{course}/getParts', 'CourseController@partsJson');
Route::get('/startedCourses/{id}', 'CourseProgressController@indexJson');
Route::get('/exercises/{coursePart}', 'ExerciseController@indexJson');
Route::get('/getCompletedExercises/{user}', 'CourseProgressController@getExercises');
Route::get('/getMessages/{user}/{cUser}','MessageController@getMessages');
Route::get('/getUnreadMessages/{user}/{contact}','MessageController@getUnreadMessages');
Route::get('/getUsers/{user}','MessageController@getUsers');
Route::get('/getStats/{course}','CourseController@getStats');
Route::get('/getLastCourse/{user}','CourseController@getLastCourse');
Route::get('/{user}/getMyCourses','CourseController@getMyCourses');


Route::post('/startCourse', 'CourseProgressController@store');
Route::post('/exercises', 'ExerciseController@store');
Route::post('/sendMessage','MessageController@sendMessage');
Route::post('/searchCourses','CourseController@search');
Route::post('/searchCategories','CategoryController@search');
Route::post('/uploadVideo','CoursePartController@upload');


Route::patch('/updateProgress/{user}', 'CourseProgressController@updateProgress');
Route::patch('/changeLastCourse','CourseController@changeLastCourse');

Route::delete('/exercises/{exercise}','ExerciseController@destroy');

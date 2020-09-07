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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/categories', 'CategoryController@indexJson');
Route::get('/courses', 'CourseController@indexJson');
Route::get('/courses/{course}/getProgress/{user}', 'CourseController@getProgress');
Route::get('/courses/{course}/getParts', 'CourseController@partsJson');
Route::get('/startedCourses/{id}', 'CourseProgressController@indexJson');
Route::get('/exercises/{coursePart}', 'ExerciseController@indexJson');
Route::get('/getCompletedExercises/{user}', 'CourseProgressController@getExercises');

Route::post('/startCourse', 'CourseProgressController@store');
Route::post('/exercises', 'ExerciseController@store');

Route::patch('/updateProgress/{user}', 'CourseProgressController@updateProgress');

Route::delete('/exercises/{exercise}','ExerciseController@destroy');

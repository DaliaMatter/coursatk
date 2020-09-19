<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;


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

Auth::routes(['verify' => true]);


// for admin
Route::middleware(['Admin'])->group(function () {
    Route::get('/Admin', [App\Http\Controllers\HomeController::class, 'index'])->name('Admin')->middleware('verified');

    Route::resource('/Admin/courses', 'App\Http\Controllers\CourseController');

    Route::get('/Admin/courses', function () {
        return view('courses', ['courses' => Course::all()]);
    })->name('course');
});

// for student 
Route::middleware(['Student'])->group(function () {
    Route::get('/home', 'App\Http\Controllers\HomeController@userIndex')->name('home')->middleware('verified');
    Route::post('/Enroll', 'App\Http\Controllers\EnrollmentController@store')->name('store');
    Route::delete('/Drop', 'App\Http\Controllers\EnrollmentController@destroy')->name('drop');
});
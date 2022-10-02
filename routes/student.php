<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:student']
    ],
    function () {

        //==============================dashboard============================
        Route::get('/student/dashboard', function () {
            return view('page.Students.dashboard');
        });

        Route::group(['namespace' => 'App\Http\Controllers\Students\dashboard'], function () {
            Route::resource('student_exams', 'ExamsController');
            Route::resource('profile-student', 'ProfileController');
        });
    }
);

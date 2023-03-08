<?php

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:teacher']
    ],
    function () {
        //==============================dashboard============================
        Route::get('/teacher/dashboard', function () {
            $ids = Teacher::findorFail(auth()->user()->id)->sections()->pluck('section_id');
            $data['count_sections'] = $ids->count();
            $data['count_students'] = \App\Models\Student::whereIn('section_id', $ids)->count();

            return view('page.Teachers.dashboard', $data);
        });

        Route::group(['namespace' => 'App\Http\Controllers\Teachers\students'], function () {
            //==============================students============================
            Route::get('student', 'StudentController@index')->name('student.index');
            Route::get('sections', 'StudentController@sections')->name('sections');
            Route::post('attendance', 'StudentController@attendance')->name('attendance');
            Route::post('edit_attendance', 'StudentController@editAttendance')->name('attendance.edit');
            Route::get('attendance_report', 'StudentController@attendanceReport')->name('attendance.report');
            Route::post('attendance_report', 'StudentController@attendanceSearch')->name('attendance.search');
            Route::resource('quizzes', QuizzController::class);
            Route::resource('questions', QuestionController::class);
            Route::get('profile', 'ProfileController@index')->name('profile.show');
            Route::post('profile/{id}', 'ProfileController@update')->name('profile.update');
            Route::get('student_quizze/{id}', 'QuizzController@student_quizze')->name('student.quizze');
            Route::post('repeat_quizze', 'QuizzController@repeat_quizze')->name('repeat.quizze');
        });
    }
);

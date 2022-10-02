<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Student;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:parent']
    ],
    function () {

        //==============================dashboard============================
        Route::get('/parent/dashboard', function () {
            $sons = Student::where('parent_id', auth()->user()->id)->get();
            return view('page.Parents.dashboard', compact('sons'));
        });

        Route::group(['namespace' => 'App\Http\Controllers\Parents\dashboard'], function () {
            Route::get('children', 'ChildrenController@index')->name('sons.index');
            Route::get('results/{id}', 'ChildrenController@results')->name('sons.results');

            Route::get('attendances', 'ChildrenController@attendances')->name('sons.attendances');
            Route::post('attendances', 'ChildrenController@attendanceSearch')->name('sons.attendance.search');

            Route::get('fees', 'ChildrenController@fees')->name('sons.fees');
            Route::get('receipt/{id}', 'ChildrenController@receiptStudent')->name('sons.receipt');

            Route::get('profile/parent', 'ChildrenController@profile')->name('profile.show.parent');
            Route::post('profile/parent/{id}', 'ChildrenController@update')->name('profile.update.parent');
        });
    }
);

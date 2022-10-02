<?php

use Illuminate\Support\Facades\Route;

Route::group(
    ['namespace' => 'App\Http\Controllers'],
    function () {
        Route::get('/', 'HomeController@index')->name('selection');
    }
);

Route::group(
    ['namespace' => 'App\Http\Controllers\Auth'],
    function () {

        Route::get('/login/{type}', 'LoginController@loginForm')->middleware('guest')->name('login.show');

        Route::post('/login', 'LoginController@login')->name('login');

        Route::get('/logout/{type}', 'LoginController@logout')->name('logout');
    }
);


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth'],
    ],
    function () {

        Route::group(['namespace' => 'App\Http\Controllers'], function () {
            Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
        });

        Route::group(['namespace' => 'App\Http\Controllers\Grades'], function () {
            Route::resource('Grades', GradeController::class);
        });

        Route::group(['namespace' => 'App\Http\Controllers\Classrooms'], function () {
            Route::resource('Classes', ClassroomController::class);
            Route::post('Filter_Classes', 'ClassroomController@Filter_Classes')->name('Filter_Classes');
            Route::post('delete_all', 'ClassroomController@delete_all')->name('delete_all');
        });
        Route::group(['namespace' => 'App\Http\Controllers\Sections'], function () {
            Route::resource('Sections', SectionController::class);
            Route::get('/classes/{id}', 'SectionController@getclasses');
        });

        Route::view('add_parent', 'livewire.show_Form')->name('add_parent');

        Route::group(['namespace' => 'App\Http\Controllers\Teachers'], function () {
            Route::resource('Teachers', TeacherController::class);
        });

        Route::group(['namespace' => 'App\Http\Controllers\Students'], function () {
            Route::resource('Students', 'StudentController');
            Route::resource('Graduated', 'GraduatedController');
            Route::resource('Promotion', 'PromotionController');
            Route::resource('Fees_Invoices', 'FeesInvoicesController');
            Route::resource('Fees', 'FeesController');
            Route::resource('receipt_students', 'ReceiptStudentsController');
            Route::resource('ProcessingFee', 'ProcessingFeeController');
            Route::resource('Payment_students', 'PaymentController');
            Route::resource('Attendance', 'AttendanceController');
            Route::resource('library', 'LibraryController');
            Route::get('download_file/{filename}', 'LibraryController@downloadAttachment')->name('downloadAttachment');
            Route::post('Upload_attachment', 'StudentController@Upload_attachment')->name('Upload_attachment');
            Route::get('Download_attachment/{studentsname}/{filename}', 'StudentController@Download_attachment')->name('Download_attachment');
            Route::post('Delete_attachment', 'StudentController@Delete_attachment')->name('Delete_attachment');
        });


        Route::group(['namespace' => 'App\Http\Controllers\Subjects'], function () {
            Route::resource('subjects', SubjectController::class);
        });

        Route::group(['namespace' => 'App\Http\Controllers\Quizzes'], function () {
            Route::resource('Quizzes', QuizzController::class);
        });

        Route::group(['namespace' => 'App\Http\Controllers\Questions'], function () {
            Route::resource('Questions', QuestionController::class);
        });

        Route::group(['namespace' => 'App\Http\Controllers\Settings'], function () {
            Route::resource('settings', SettingController::class);
        });
    }

);

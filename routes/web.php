<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return view('welcome');
});

Auth::routes();

//Route::get('/clear-cache', function() {
//    $exitCode = Artisan::call('config:cache');
//    return 'DONE, exit code: '.$exitCode;
//});

Route::group(['middleware'=>['auth']], function () {
    Route::get('/student', 'StudentController@studentHome');
    Route::get('/vocabulary', 'VocabularyController@index');
    Route::get('/vocabulary-exercise', 'VocabularyController@exercise');
});


Route::group(['prefix' => 'teacher/students', 'middleware'=>['can:isTeacher']], function () {
    Route::get('/', 'StudentController@index')->name('students');
});

Route::group(['prefix' => 'admin/students', 'middleware'=>['can:isAdmin']], function () {
    Route::get('/', 'StudentController@index')->name('students');
});

Route::group(['prefix' => 'teacher', 'namespace'=>'TextTools'], function () {
    Route::get('/', 'HomeController@index')->name('texttools')->middleware('can:isTeacher');
    Route::get('/text-converter', 'TextConverterController@index')->name('texttools.text-converter')->middleware('can:isTeacher');
    Route::get('/shulte-table', 'ShulteTablesController@index')->name('texttools.shulte')->middleware('can:isTeacher');
    Route::get('/shulte-gorbova', 'ShulteGorbovaController@index')->name('texttools.shulte-gorbova')->middleware('can:isTeacher');
    Route::get('/maze', 'MazeController@index')->name('texttools.maze')->middleware('can:isTeacher');
    Route::get('/math-examples', 'MathExamplesController@index')->name('texttools.math-examples')->middleware('can:isTeacher');
    Route::get('/sudoku', 'SudokuController@index')->name('texttools.sudoku')->middleware('can:isTeacher');
    Route::get('/filwords', 'FilwordsController@index')->name('texttools.filwords')->middleware('can:isTeacher');
    Route::get('/numbers', 'GeneratorController@numbers')->name('texttools.numbers')->middleware('can:isTeacher');
    Route::get('/count', 'GeneratorController@count')->name('texttools.count')->middleware('can:isTeacher');
    Route::get('/remember-configuration', 'GeneratorController@configuration')->name('texttools.configuration')->middleware('can:isTeacher');
    Route::get('/arrange-numbers', 'GeneratorController@arrange')->name('texttools.arrange')->middleware('can:isTeacher');
    Route::get('/encoding-alphabet', 'GeneratorController@encodingAlphabet')->name('texttools.encoding-alphabet')->middleware('can:isTeacher');
    Route::get('/encoding-numbers', 'GeneratorController@encodingNumbers')->name('texttools.encoding-numbers')->middleware('can:isTeacher');
});


Route::group(['prefix' => 'admin', 'namespace'=>'TextTools'], function () {
    Route::get('/', 'HomeController@index')->name('texttools')->middleware('can:isAdmin');
    Route::get('/text-converter', 'TextConverterController@index')->name('texttools.text-converter')->middleware('can:isAdmin');
    Route::get('/shulte-table', 'ShulteTablesController@index')->name('texttools.shulte')->middleware('can:isAdmin');
    Route::get('/shulte-gorbova', 'ShulteGorbovaController@index')->name('texttools.shulte-gorbova')->middleware('can:isAdmin');
    Route::get('/maze', 'MazeController@index')->name('texttools.maze')->middleware('can:isAdmin');
    Route::get('/math-examples', 'MathExamplesController@index')->name('texttools.math-examples')->middleware('can:isAdmin');
    Route::get('/sudoku', 'SudokuController@index')->name('texttools.sudoku')->middleware('can:isAdmin');
    Route::get('/filwords', 'FilwordsController@index')->name('texttools.filwords')->middleware('can:isAdmin');
    Route::get('/numbers', 'GeneratorController@numbers')->name('texttools.numbers')->middleware('can:isAdmin');
    Route::get('/count', 'GeneratorController@count')->name('texttools.count')->middleware('can:isAdmin');
    Route::get('/remember-configuration', 'GeneratorController@configuration')->name('texttools.configuration')->middleware('can:isAdmin');
    Route::get('/arrange-numbers', 'GeneratorController@arrange')->name('texttools.arrange')->middleware('can:isAdmin');
    Route::get('/encoding-alphabet', 'GeneratorController@encodingAlphabet')->name('texttools.encoding-alphabet')->middleware('can:isAdmin');
    Route::get('/encoding-numbers', 'GeneratorController@encodingNumbers')->name('texttools.encoding-numbers')->middleware('can:isAdmin');
});

Route::group(['prefix' => 'admin/users', 'middleware'=>['admin']], function () {
    Route::get('/', 'UsersController@index');
    Route::get('/user-review/{id}', 'UsersController@userReview');
});

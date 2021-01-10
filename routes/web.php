<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return view('welcome');
});

Auth::routes();

// Route::group(['middleware' => ['auth']], function () {
//   Route::get('/home', 'HomeController@index')->name('home');
// });

Route::group(['prefix' => 'texttools', 'namespace'=>'TextTools', 'middleware'=>['auth']], function () {
    Route::get('/', 'HomeController@index')->name('texttools');
    Route::get('/text-converter', 'TextConverterController@index')->name('texttools.text-converter');
    Route::get('/shulte-table', 'ShulteTablesController@index')->name('texttools.shulte');
    Route::get('/shulte-gorbova', 'ShulteGorbovaController@index')->name('texttools.shulte-gorbova');
    Route::get('/maze', 'MazeController@index')->name('texttools.maze');
    Route::get('/math-examples', 'MathExamplesController@index')->name('texttools.math-examples');
    Route::get('/sudoku', 'SudokuController@index')->name('texttools.sudoku');
    Route::get('/filwords', 'FilwordsController@index')->name('texttools.filwords');
    Route::get('/numbers', 'GeneratorController@numbers')->name('texttools.numbers');
    Route::get('/count', 'GeneratorController@count')->name('texttools.count');
    Route::get('/remember-configuration', 'GeneratorController@configuration')->name('texttools.configuration');
    Route::get('/arrange-numbers', 'GeneratorController@arrange')->name('texttools.arrange');
    Route::get('/encoding-alphabet', 'GeneratorController@encodingAlphabet')->name('texttools.encoding-alphabet');
    Route::get('/encoding-numbers', 'GeneratorController@encodingNumbers')->name('texttools.encoding-numbers');
});
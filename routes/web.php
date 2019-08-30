<?php

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
});


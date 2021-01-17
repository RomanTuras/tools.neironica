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

Route::middleware('auth:api')->group(function (){
    Route::get('/vocabulary-get-themes/{user_id}', 'VocabularyController@getThemes');
    Route::post('/vocabulary-insert-theme/{user_id}/{language_id}/{name}', 'VocabularyController@insertTheme');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
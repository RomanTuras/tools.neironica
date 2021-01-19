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

//Route::middleware('auth:api')->group(function (){
    Route::post('/vocabulary-insert-theme/{user_id}/{language_id}/{name}', 'VocabularyController@insertTheme');
    Route::post('/vocabulary-insert-translation/{user_id}/{language_id}/{theme_id}/{variety_id}/{text_ru}/{transl}/{encode}', 'VocabularyController@insertTranslation');
    Route::post('/vocabulary-update-translation/{id}/{text_ru}/{transl}/{encode}', 'VocabularyController@updateTranslation');
    Route::post('/vocabulary-update-theme/{theme_id}/{name}', 'VocabularyController@updateTheme');
    Route::get('/vocabulary-get-themes/{user_id}', 'VocabularyController@getThemes');
    Route::get('/get-user-vocabulary/{user_id}/{language_id}/{theme_id}/{variety_id}', 'VocabularyController@getUserVocabulary');
    Route::get('/vocabulary-is-theme-exist/{user_id}/{name}', 'VocabularyController@isThemeNameExist');
//});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
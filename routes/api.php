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
    Route::post('/vocabulary-insert-theme/{user_id}/{language_id}/{name}', 'VocabularyApiController@insertTheme');
    Route::post('/vocabulary-insert-translation/{user_id}/{language_id}/{theme_id}/{variety_id}/{text_ru}/{transl}/{encode}', 'VocabularyApiController@insertTranslation');

    Route::post('/vocabulary-copy-theme/{user_to}/{user_from}/{theme_name}/{theme_id}/{language_id}/{variety_id}', 'VocabularyApiController@copyTheme');

    Route::post('/vocabulary-update-translation/{id}/{text_ru}/{transl}/{encode}', 'VocabularyApiController@updateTranslation');
    Route::post('/vocabulary-update-theme/{theme_id}/{name}', 'VocabularyApiController@updateTheme');
//    Route::post('/vocabulary-update-theme/{object}', 'VocabularyApiController@updateTheme');

    Route::get('/vocabulary-get-themes/{user_id}', 'VocabularyApiController@getThemes');
    Route::get('/get-user-vocabulary/{user_id}/{language_id}/{theme_id}/{variety_id}', 'VocabularyApiController@getUserVocabulary');
    Route::get('/get-user-exercise/{user_id}/{language_id}/{theme_id}/{variety_id}/{num}', 'VocabularyApiController@getUserExercise');
    Route::get('/vocabulary-is-theme-exist/{user_id}/{name}', 'VocabularyApiController@isThemeNameExist');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
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

    Route::post('/users/change-role/{id}/{role}', 'UsersController@changeUserRole');
    Route::post('/users/delete-user/{id}', 'UsersController@deleteUser');
    Route::get('/users', 'UsersController@getUsers');
});

Route::middleware('auth:api')->group(function (){
    Route::post('/puzzle-insert-folder/{name}', 'PuzzleController@insertFolderName');
    Route::post('/puzzle-update-folder-name/{id}/{name}', 'PuzzleController@updateFolderName');
    Route::get('/puzzle-folders', 'PuzzleController@getPuzzleFolders');
    Route::get('/puzzle/{folderId}', 'PuzzleController@getAllPuzzles');
    Route::post('/puzzle/store-image/{folderId}', 'PuzzleController@storeImage');
    Route::post('/puzzle/store-puzzle-image/{folderId}', 'PuzzleController@insertNewPuzzleImage');
    Route::post('/puzzle/update-puzzle-image/{puzzleId}/{folderId}', 'PuzzleController@updatePuzzleImage');
    Route::delete('/puzzle/delete-puzzle/{puzzleId}/{folderId}', 'PuzzleController@deletePuzzle');
});

//FilWords
Route::middleware('auth:api')->group(function () {
    Route::get('/filwords/words/{quantity}/{minLength}/{maxLength}', 'FillWordsController@getRandomWords');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



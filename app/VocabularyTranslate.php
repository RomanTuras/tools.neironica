<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class VocabularyTranslate extends Model
{
    protected $fillable = ['id'];

    /**
     * Get translation of text, depend on user vocabulary and particular language
     * @param $userId
     * @param $languageId
     * @param $text
     *
     * @return mixed
     */
    public function translateText($userId, $languageId, $text) {
        return DB::table('vocabulary_translate')
            ->where('user_id', '=', $userId)
            ->where('language_id', '=', $languageId)
            ->where('text_ru', 'like', $text)
            ->pluck('translation')
            ->first();
    }

    /**
     * Getting a vocabulary of user, depend on language, particular theme and variety
     *
     * @param $userId
     * @param $languageId
     * @param $themeId
     * @param $varietyId
     *
     * @return \Illuminate\Support\Collection
     */
    public function getUserVocabulary($userId, $languageId, $themeId, $varietyId) {
        return DB::table('vocabulary_translate')
             ->where('user_id', '=', $userId)
             ->where('language_id', '=', $languageId)
             ->where('theme_id', '=', $themeId)
             ->where('variety_id', '=', $varietyId)
             ->get();
    }

}

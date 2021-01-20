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
             ->orderBy('text_ru')
             ->get();
    }

    public function getUserExercise($userId, $languageId, $themeId, $varietyId, $num) {
        return DB::table('vocabulary_translate')
            ->where('user_id', '=', $userId)
            ->where('language_id', '=', $languageId)
            ->where('theme_id', '=', $themeId)
            ->where('variety_id', '=', $varietyId)
            ->inRandomOrder()
            ->limit($num)
            ->get();
    }

    public function insertTranslation($userId, $languageId, $themeId, $varietyId, $textRu, $transl, $encode) {
        DB::table('vocabulary_translate')
            ->insert([
                'user_id'=>$userId,
                'language_id'=>$languageId,
                'theme_id'=>$themeId,
                'variety_id'=>$varietyId,
                'text_ru'=>$textRu,
                'translation'=>$transl,
                'encoding'=>$encode,
                'created_at' => now()
            ]);
    }

    public function updateTranslation($id, $textRu, $transl, $encode) {
        DB::table('vocabulary_translate')
            ->where('id', '=', $id)
            ->update(['text_ru' => $textRu, 'translation' => $transl, 'encoding' => $encode, 'updated_at' => now()]);
    }

}

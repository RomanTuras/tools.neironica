<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class VocabularyTheme extends Model
{
    public $timestamps = false;
    protected $fillable = ['id'];

    public function vocabularyTranslate(){
        return $this->belongsToMany(VocabularyTranslate::class);
    }

    /**
     * Getting all themes of user
     *
     * @param $userId
     *
     * @return Collection
     */
    public function getThemes($userId) {
        return DB::table('vocabulary_theme')
            ->where('user_id', '=', $userId)
            ->orderBy('name')
            ->get();
    }

    /**
     * Inserting a new theme
     *
     * @param $userId
     * @param $languageId
     * @param $name
     *
     * @return int
     */
    public function insertTheme($userId, $languageId, $name) {
        return DB::table('vocabulary_theme')
                 ->insertGetId(['name'=>$name, 'user_id'=>$userId, 'language_id'=>$languageId]);
    }

    /**
     * Update theme by ID
     * @param $themeId
     * @param $name
     */
    public function updateTheme($themeId, $name) {
        DB::table('vocabulary_theme')
            ->where('id', '=', $themeId)
            ->update(['name' => $name]);
    }

    /**
     * Checking is theme name exist by user ID
     * @param $userId
     * @param $name
     *
     * @return bool
     */
    public function isThemeNameExist($userId, $name) {
        $themeName = DB::table('vocabulary_theme')
            ->where('name', 'like', $name)
            ->where('user_id', '=', $userId)
            ->get();
        return count($themeName )== 0 ? false : true;
    }
}

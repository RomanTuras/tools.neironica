<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
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
     * @return \Illuminate\Support\Collection
     */
    public function getThemes($userId) {
        return DB::table('vocabulary_theme')
            ->where('user_id', '=', $userId)
            ->orderBy('name')
            ->get();
    }

    public function insertTheme($userId, $languageId, $name) {
        DB::table('vocabulary_theme')
            ->updateOrInsert(['name'=>$name, 'user_id'=>$userId, 'language_id'=>$languageId]);
    }
}

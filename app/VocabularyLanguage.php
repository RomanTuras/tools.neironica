<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class VocabularyLanguage extends Model
{
    public $timestamps = false;
    protected $fillable = ['id'];

    public function vocabularyThemes(){
        return $this->belongsToMany(VocabularyTheme::class);
    }

    public function vocabularyTranslate(){
        return $this->belongsToMany(VocabularyTranslate::class);
    }

    /**
     * Get all languages
     * @return \Illuminate\Support\Collection
     */
    public function getLanguages() {
        return DB::table('vocabulary_language')
            ->get();
    }
}
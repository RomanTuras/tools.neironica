<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
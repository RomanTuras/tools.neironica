<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VocabularyTheme extends Model
{
    public $timestamps = false;
    protected $fillable = ['id'];

    public function vocabularyTranslate(){
        return $this->belongsToMany(VocabularyTranslate::class);
    }
}

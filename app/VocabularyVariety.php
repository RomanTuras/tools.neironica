<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class VocabularyVariety extends Model
{
    public $timestamps = false;
    protected $fillable = ['id'];

    public function vocabularyTranslate(){
        return $this->belongsToMany(VocabularyTranslate::class);
    }

    /**
     * Getting all varieties
     * @return \Illuminate\Support\Collection
     */
    public function getVarieties() {
        return DB::table('vocabulary_variety')
            ->get();
    }
}

<?php

namespace App\Http\Controllers;

use App\VocabularyLanguage;
use App\VocabularyTheme;
use App\VocabularyTranslate;
use App\VocabularyVariety;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Collection;

class VocabularyController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Getting languages
     * @return Collection
     */
    public function getLanguages() {
        $vl = new VocabularyLanguage();
        return $vl->getLanguages();
    }

    /**
     * Getting varieties
     * @return Collection
     */
    public function getVarieties() {
        $vv = new VocabularyVariety();
        return $vv->getVarieties();
    }

    /**
     * Getting all user themes
     * @param $userId
     *
     * @return Collection
     */
    public function getThemes($userId) {
        $vt = new VocabularyTheme();
        return $vt->getThemes($userId);
    }

    /**
     * Insert a new theme
     * @param $userId
     * @param $languageId
     * @param $name
     */
    public function insertTheme($userId, $languageId, $name) {
        $vt = new VocabularyTheme();
        $vt->insertTheme($userId, $languageId, $name);
    }

    /**
     * Update theme by ID
     * @param $themeID
     * @param $name
     */
    public function updateTheme($themeID, $name) {
        $vt = new VocabularyTheme();
        $vt->updateTheme($themeID, $name);
    }

    /**
     * Translating text, using user vocabulary
     * @param $userId
     * @param $languageId
     * @param $text
     *
     * @return mixed
     */
    public function translateText($userId, $languageId, $text) {
        $vTrans = new VocabularyTranslate();
        return $vTrans->translateText($userId, $languageId, $text);
    }

    /**
     * Getting a user vocabulary, depend on language, theme and variety
     * @param $userId
     * @param $languageId
     * @param $themeId
     * @param $varietyId
     */
    public function getUserVocabulary($userId, $languageId, $themeId, $varietyId) {
        $vTrans = new VocabularyTranslate();
        $vTrans->getUserVocabulary($userId, $languageId, $themeId, $varietyId);
    }

}

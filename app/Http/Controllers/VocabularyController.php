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
        $name = htmlentities($name, ENT_QUOTES, 'UTF-8', false);
        $vt = new VocabularyTheme();
        $vt->insertTheme($userId, $languageId, $name);
    }

    /**
     * Update theme by ID
     * @param $themeID
     * @param $name
     */
    public function updateTheme($themeID, $name) {
        $name = htmlentities($name, ENT_QUOTES, 'UTF-8', false);
        $vt = new VocabularyTheme();
        $vt->updateTheme($themeID, $name);
    }

    /**
     * Checking is theme name exist by user ID
     *
     * @param $userId
     * @param $name
     *
     * @return array
     */
    public function isThemeNameExist($userId, $name) {
        $vt = new VocabularyTheme();
        return ['data' => $vt->isThemeNameExist($userId, $name)];
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
     *
     * @param $userId
     * @param $languageId
     * @param $themeId
     * @param $varietyId
     *
     * @return Collection
     */
    public function getUserVocabulary($userId, $languageId, $themeId, $varietyId) {
        $vTrans = new VocabularyTranslate();
        return $vTrans->getUserVocabulary($userId, $languageId, $themeId, $varietyId);
    }

    public function insertTranslation($userId, $languageId, $themeId, $varietyId, $textRu, $transl, $encode) {
        $textRu = htmlentities($textRu, ENT_QUOTES, 'UTF-8', false);
        $transl = htmlentities($transl, ENT_QUOTES, 'UTF-8', false);
        $encode = htmlentities($encode, ENT_QUOTES, 'UTF-8', false);
        $vTrans = new VocabularyTranslate();
        $vTrans->insertTranslation($userId, $languageId, $themeId, $varietyId, $textRu, $transl, $encode);
    }

    public function updateTranslation($id, $textRu, $transl, $encode) {
        $textRu = htmlentities($textRu, ENT_QUOTES, 'UTF-8', false);
        $transl = htmlentities($transl, ENT_QUOTES, 'UTF-8', false);
        $encode = htmlentities($encode, ENT_QUOTES, 'UTF-8', false);
        $vTrans = new VocabularyTranslate();
        $vTrans->updateTranslation($id, $textRu, $transl, $encode);
    }

}

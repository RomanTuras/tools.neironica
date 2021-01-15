<?php

namespace App\Http\Controllers;

use App\VocabularyLanguage;
use App\VocabularyTheme;
use App\VocabularyTranslate;
use App\VocabularyVariety;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        dd('student index page');
    }

    public function home()
    {
        $vl = new VocabularyLanguage();
        $languages = $vl->getLanguages();
        foreach ($languages as $language) {
//            echo $language->id.' - '.$language->name. '<br>';
        }


        $vv = new VocabularyVariety();
        $varieties = $vv->getVarieties();
        foreach ($varieties as $variety) {
//            echo $variety->id.' - '.$variety->name. '<br>';
        }


        $vt = new VocabularyTheme();
        $themes = $vt->getThemes(Auth::id());
        foreach ($themes as $theme) {
//            echo $theme->id.' - '.$theme->name. '<br>';
        }


        $vTrans = new VocabularyTranslate();
        $translate = $vTrans->translateText(Auth::id(), 1, "собака есть собака");


        $vocabulary = $vTrans->getUserVocabulary(Auth::id(), 1, 1, 1);
        foreach ($vocabulary as $w) {
//            echo $w->id.' - '.$w->text_ru.' - '.$w->translation. '<br>';
        }




        return view('students.home');
    }
}

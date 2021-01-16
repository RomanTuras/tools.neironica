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

    public function home() {
        return view('students.home',
            ['data' =>
                 ['page' => 'students.home']
            ]);
    }

    public function vocabulary() {
        $vc = new VocabularyController();
        $languages = $vc->getLanguages();
        $varieties = $vc->getVarieties();
        return view('students.vocabulary',
            ['data' =>
                 [
                     'page' => 'students.vocabulary-add',
                     'languages' => $languages,
                     'varieties' => $varieties,
                     'user_id' => Auth::id(),
                     ]
            ]);
    }

    public function exercise() {
        $vc = new VocabularyController();
        $languages = $vc->getLanguages();
        return view('students.vocabulary-exercise',
            ['data' =>
                 ['page' => 'students.vocabulary-exercise', 'languages' => $languages]
            ]);
    }
}

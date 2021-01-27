<?php

namespace App\Http\Controllers;

use App\User;
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
    public function index() {
        $vc = new VocabularyApiController();
        $languages = $vc->getLanguages();
        $varieties = $vc->getVarieties();
        return view('students.students',
            ['data' =>
                 [
                     'page' => 'students',
                     'languages' => $languages,
                     'varieties' => $varieties,
                     'user_id' => null,
                     'students' => User::getAllUsers(),
                 ]
            ]);
    }


    public function studentHome() {
        return view('students.home',
            ['data' =>
                 ['page' => 'students.home']
            ]);
    }
}

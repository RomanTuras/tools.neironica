<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Auth;

class VocabularyController extends Controller
{
    use AuthorizesRequests, DispatchesJobs;

    public function index() {
        $vc = new VocabularyApiController();
        $languages = $vc->getLanguages();
        $varieties = $vc->getVarieties();
        return view('students.vocabulary',
            ['data' =>
                 [
                     'page' => 'students.vocabulary',
                     'languages' => $languages,
                     'varieties' => $varieties,
                     'user_id' => Auth::id(),
                 ]
            ]);
    }

    public function exercise() {
        $vc = new VocabularyApiController();
        $languages = $vc->getLanguages();
        $varieties = $vc->getVarieties();
        return view('students.vocabulary-exercise',
            ['data' =>
                 [
                     'page' => 'students.vocabulary-exercise',
                     'languages' => $languages,
                     'varieties' => $varieties,
                     'user_id' => Auth::id(),
                 ]
            ]);
    }

}

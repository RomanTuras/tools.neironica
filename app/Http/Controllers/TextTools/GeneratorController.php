<?php

namespace App\Http\Controllers\TextTools;

use App\Http\Controllers\Controller;

class GeneratorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Getting a Numbers view, starting a Number Generator logic
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function numbers()
    {
        return view('texttools.numbers');
    }

    /**
     * Getting a Count view, starting a Count Generator logic
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function count()
    {
        return view('texttools.count');
    }
}

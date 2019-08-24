<?php

namespace App\Http\Controllers\TextTools;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MathExamplesController extends Controller
{
    /**
     * Show the application Math Examples.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('texttools.math-examples');
    }
}

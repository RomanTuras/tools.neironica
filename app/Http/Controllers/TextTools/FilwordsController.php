<?php

namespace App\Http\Controllers\TextTools;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FilwordsController extends Controller
{
    /**
     * Show the application Filwords generator.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('texttools.filwords');
    }
}

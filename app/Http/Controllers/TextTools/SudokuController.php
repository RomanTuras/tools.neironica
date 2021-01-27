<?php

namespace App\Http\Controllers\TextTools;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SudokuController extends Controller
{
    /**
     * Show the application Sudoku generator.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('texttools.sudoku',
            ['data' =>
                 ['page' => 'texttools']
            ]);
    }
}

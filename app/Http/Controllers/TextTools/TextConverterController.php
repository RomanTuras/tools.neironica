<?php

namespace App\Http\Controllers\TextTools;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TextConverterController extends Controller
{
  /**
   * Show the application text converter.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    return view('texttools.textconverter',
        ['data' =>
             ['page' => 'texttools']
        ]);
  }
}

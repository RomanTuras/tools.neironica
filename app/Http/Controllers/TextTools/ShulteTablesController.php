<?php

namespace App\Http\Controllers\TextTools;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShulteTablesController extends Controller
{
  /**
   * Show the application Shulte table.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
      return view('texttools.shulte',
          ['data' =>
               ['page' => 'texttools']
          ]);
  }
}

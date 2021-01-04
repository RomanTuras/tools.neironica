<?php

namespace App\Http\Controllers\TextTools;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class GeneratorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Getting a Numbers view, starting a Number Generator logic
     * @return Factory|View
     */
    public function numbers()
    {
        return view('texttools.numbers');
    }

    /**
     * Getting a Count view, starting a Count Generator logic
     * @return Factory|View
     */
    public function count()
    {
        return view('texttools.count');
    }

    /**
     * Getting a Remember Configuration view, starting a Remember Config logic
     * @return Factory|View
     */
    public function configuration()
    {
        return view('texttools.configuration');
    }

    /**
     * Getting a Arrange view, starting a Arrange Numbers logic
     * @return Factory|View
     */
    public function arrange()
    {
        return view('texttools.arrange');
    }
}

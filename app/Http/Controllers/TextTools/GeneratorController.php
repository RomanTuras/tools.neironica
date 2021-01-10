<?php

namespace App\Http\Controllers\TextTools;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\DB;
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

    /**
     * Getting a Encoding-alphabet view
     * @return Factory|View
     */
    public function encodingAlphabet()
    {
        $words = DB::table('words')
            ->where('text', '!=', '')
            ->limit(1)
            ->pluck('text');

        $words = trim(mb_strtolower($words[0]));

        return view('texttools.encoding-alphabet', ['words' => $words]);
    }

    /**
     * Getting a Encoding-numbers view
     * @return Factory|View
     */
    public function encodingNumbers()
    {
        return view('texttools.encoding-numbers');
    }
}

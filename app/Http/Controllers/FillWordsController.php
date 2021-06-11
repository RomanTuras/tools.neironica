<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class FillWordsController extends Controller
{

    /**
     * Getting a random words
     * @param $quantity
     * @param $minLength
     * @param $maxLength
     *
     * @return Collection
     */
    public function getRandomWords($quantity, $minLength, $maxLength) {
        return DB::table('words')
                    ->whereRaw('CHAR_LENGTH(text) >= ' . $minLength . ' AND CHAR_LENGTH(text) <= ' . $maxLength)
                    ->select('text')
                    ->inRandomOrder()
                    ->limit($quantity)
                    ->get();
    }

    /**
     * Fill the table by words, tacked from first row
     * Required once, when getting a first data
     */
    public function fillWords() {
        $isWordsFilled = DB::table('words')->whereRaw('CHAR_LENGTH(text) < 10')->exists();
        if (!$isWordsFilled) {
            $response = DB::table('words')->whereRaw('CHAR_LENGTH(text) > 100')->first();
            $text = $response->text;
            $words = explode( ' ', $text);
            foreach ($words as $word){
                DB::table('words')->insert(['text' => $word]);
            }
        }
    }
}

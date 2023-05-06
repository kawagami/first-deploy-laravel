<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ThumborController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filter_style_array = [
            1 => "Oceanic",
            2 => "Islands",
            3 => "Marine",
            4 => "Seagreen",
            5 => "Flagblue",
            6 => "Liquid",
            7 => "Diamante",
            8 => "Radio",
            9 => "Twenties",
            10 => "Rosetint",
            11 => "Mauve",
            12 => "Bluechrome",
            13 => "Vintage",
            14 => "Perfume",
            15 => "Serenity",
        ];

        return view('thumbor')
            ->with("filter_style_array", $filter_style_array);
    }
}

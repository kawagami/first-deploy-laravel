<?php

namespace App\Http\Controllers;

use App\Models\SgVite;
use Illuminate\Http\Request;

class SgViteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SgVite::get();
    }
}

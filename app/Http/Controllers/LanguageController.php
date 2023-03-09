<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLanguageRequest;
use App\Http\Requests\UpdateLanguageRequest;
use App\Models\Language;

class LanguageController extends Controller
{
    public function lang(string $lang)
    {
        // $langs = Language::where('is_online', true)->pluck('code')->get();
        $langs = collect(trans('langs'))->keys();
        if (!$langs->contains($lang)) {
            $lang = 'en';
        }
        session()->put('locale', $lang);
        return back();
    }
}

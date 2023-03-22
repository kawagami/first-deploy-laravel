<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Chatgpt;
use App\Models\LineBot;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $raw_line_bot = LineBot::get();
        $line_bot = [
            "keys" => collect($raw_line_bot->last())->keys(),
            "values" => $raw_line_bot->values(),
        ];
        $raw_chatgpt = Chatgpt::get();
        $chatgpt = [
            "keys" => collect($raw_chatgpt->last())->keys(),
            "values" => $raw_chatgpt->values(),
        ];

        $data = [
            "line_bot" => $line_bot,
            "chatgpt" => $chatgpt,
        ];

        return response()->json($data);
    }
}

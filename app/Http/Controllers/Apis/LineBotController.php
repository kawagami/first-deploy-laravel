<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Services\LineBot\BaseService as Service;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class LineBotController extends Controller
{
    protected $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    public function handleRequest(Request $request)
    {
        DB::beginTransaction();
        try {
            $result = $this->service->handle_request();
            DB::commit();
        } catch (\Exception $e) {
            info($e->getMessage());
            DB::rollback();

            return response('', 400);
        }

        return response()->json(['status' => 'success']);
    }
}

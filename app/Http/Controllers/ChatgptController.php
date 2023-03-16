<?php

namespace App\Http\Controllers;

use App\Services\Chatgpt\BaseService as Service;

class ChatgptController extends Controller
{
    public $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    public function request(string $request_message)
    {
        try {
            return $this->service->request($request_message);
        } catch (\Exception $error) {
            info($error->getMessage());

            return $error->getMessage();
        }
    }
}

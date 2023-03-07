<?php

namespace App\Http\Controllers\Socialite;

use App\Http\Controllers\Controller;
use App\Services\Socialite\BaseService as Service;

class BaseController extends Controller
{
    public $auth_name = "third_part_name";
    protected $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
        $this->set_auth_name();
    }

    public function set_auth_name(): void
    {
        $this->service->set_auth_name($this->auth_name);
    }

    public function gitRedirect()
    {
        return $this->service->gitRedirect();
    }

    public function gitCallback()
    {
        try {
            return $this->service->gitCallback();
        } catch (\Exception $e) {
            info($e);
            return redirect(route('index'))->with('error', 'something wrong!');
        }
    }
}

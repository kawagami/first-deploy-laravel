<?php

namespace App\Http\Controllers\Socialite;

use App\Http\Controllers\Controller;
use App\Services\Socialite\BaseService as Service;

class BaseController extends Controller
{
    public $login_name = 'here_is_third_name';
    protected $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
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

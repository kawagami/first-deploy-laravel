<?php

namespace App\Services\Socialite;

use App\Repositories\Socialite\BaseRepository as Repository;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BaseService
{
    public $auth_name;
    public $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function set_auth_name(string $auth_name):void
    {
        $this->auth_name = $auth_name;
    }

    public function redirect()
    {
        return Socialite::driver($this->auth_name)->redirect();
    }

    public function callback()
    {
        $user = Socialite::driver($this->auth_name)->user();
        // 檢查 email 是否存在
        // 存在
        if ($auth_user = $this->repository->user_email_is_exists($user->email)) {
            // 檢查是否有相同的 auth_type
            if ($same_auth_type = $this->repository->user_has_same_auth_type($auth_user, $this->auth_name)) {
                // 檢查該認證 ID 是否相同
                if ($same_auth_type->auth_id == $user->id) {
                    // 是
                    // 更新 token 之類的東西
                    // 登入
                    Auth::login($auth_user);
                } else {
                    // 否 會有這狀況嗎?
                    info(json_encode($user));
                    info(json_encode($same_auth_type));
                    throw new \Exception('did this happen?');
                }
            } else {
                // 沒有
                $data = [
                    'user_id'   => $auth_user->id,
                    'auth_id'   => $user->id,
                    'auth_type' => $this->auth_name,
                    'name'      => $user->name ?? $user->nickname ?? $user->email,
                    'nickname'  => $user->nickname,
                    'avatar'    => $user->avatar,
                    'token'     => $user->token,
                ];
                $new_auth = $this->repository->create_auth($data);
                $this->repository->user_add_auth($auth_user, $new_auth);
                Auth::login($auth_user);
                // 子表新增 auth_type & 該認證 ID
                // 登入
            }
        } else {
            // 不存在
            // 新增 user
            // 子表新增 auth_type & 該認證 ID
            // 登入
            $user_data = [
                'name'     => $user->name ?? $user->nickname ?? $user->email,
                'email'    => $user->email,
                'password' => encrypt(Str::random(10))
            ];
            $new_user = $this->repository->create_user($user_data);
            $auth_data = [
                'user_id'   => $new_user->id,
                'auth_id'   => $user->id,
                'auth_type' => $this->auth_name,
                'name'      => $user->name ?? $user->nickname ?? $user->email,
                'nickname'  => $user->nickname,
                'avatar'    => $user->avatar,
                'token'     => $user->token,
            ];
            $new_auth = $this->repository->create_auth($auth_data);
            $this->repository->user_add_auth($new_user, $new_auth);
            Auth::login($new_user);
        }
        return redirect(route('index'));
    }
}

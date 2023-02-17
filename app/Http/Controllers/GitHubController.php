<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\UserLogin;

class GitHubController extends Controller
{
    private $login_name = 'github';

    public function gitRedirect()
    {
        return Socialite::driver($this->login_name)->redirect();
    }

    public function gitCallback()
    {
        try {
            $user      = Socialite::driver($this->login_name)->user();
            $auth_user = User::where('email', $user->email)->with('user_logins')->first();
            // 檢查 email 是否存在
            // 存在
            if ($auth_user) {
                // 檢查是否有相同的 auth_type
                if ($auth_user->user_logins()->contains('auth_type', $this->login_name)) {
                    // 檢查該認證 ID 是否相同
                    $same_auth_type = $auth_user->user_logins()->firstWhere('auth_type', $this->login_name);
                    if ($same_auth_type->auth_id == $user->id) {
                        // 是
                        // 更新 token 之類的東西
                        // 登入
                        Auth::login($auth_user);
                    } else {
                        // 否 會有這狀況嗎?
                        info(json_encode($user));
                        info(json_encode($same_auth_type));
                        throw new Exception('did this happen?');
                    }
                } else {
                    // 沒有
                    $data = [
                        // 'user_id'   => $user_id,
                        'auth_id'   => $user->id,
                        'auth_type' => $this->login_name,
                        'name'      => $user->name ?? $user->nickname ?? $user->email,
                        'nickname'  => $user->nickname,
                        'avatar'    => $user->avatar,
                        'token'     => $user->token,
                    ];
                    $new_auth = new UserLogin($data);
                    $auth_user->user_logins()->save($new_auth);
                    Auth::login($auth_user);
                    // 子表新增 auth_type & 該認證 ID
                    // 登入
                }
            } else {
                // 不存在
                // 新增 user
                // 子表新增 auth_type & 該認證 ID
                // 登入
                $data = [
                    // 'user_id'   => $user_id,
                    'auth_id'   => $user->id,
                    'auth_type' => $this->login_name,
                    'name'      => $user->name ?? $user->nickname ?? $user->email,
                    'nickname'  => $user->nickname,
                    'avatar'    => $user->avatar,
                    'token'     => $user->token,
                ];
                $new_auth = new UserLogin($data);
                $gitUser = User::create([
                    'name' => $user->name ?? $user->nickname ?? $user->email,
                    'email' => $user->email,
                    'github_id' => $user->id,
                    'auth_type' => $this->login_name,
                    'password' => encrypt($user->email)
                ]);
                $gitUser->user_logins()->save($new_auth);
                Auth::login($gitUser);
            }
            return redirect('/home');
            // ==============================

            // // info(json_encode($user));
            // $searchUser = User::where('github_id', $user->id)->first();
            // if ($searchUser) {
            //     Auth::login($searchUser);
            //     return redirect('/home');
            // } else {
            //     $gitUser = User::create([
            //         'name' => $user->name ?? $user->nickname ?? $user->email,
            //         'email' => $user->email,
            //         'github_id' => $user->id,
            //         'auth_type' => $this->login_name,
            //         'password' => encrypt($user->email)
            //     ]);
            //     Auth::login($gitUser);
            //     return redirect('/home');
            // }
        } catch (Exception $e) {
            info($e);
            return redirect('/')->with('error', 'something wrong!');
            // return response('something wrong!', 400);
            // dd($e->getMessage());
        }
    }
}

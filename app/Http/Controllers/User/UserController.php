<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
// use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $authorizationHeader = $request->header('Authorization');

        if ($authorizationHeader) {
            // 使用空格分割 Authorization 头部，并获取第二部分
            $parts = explode(' ', $authorizationHeader);
            if (count($parts) === 2 && $parts[0] === 'Bearer') {
                $token = $parts[1]; // 这里是 Token 的部分
                $id = cache($token);
                if ($id) {
                    $user = User::select(['email'])->find($id);

                    return $this->ok([$user], '受到 sgtoken 保護的資料');
                }

                return $this->bad_request([], 'token 對應的 ID 不存在');
            }

            return $this->bad_request([], 'token 格式有誤');
        }

        return $this->unauthorized([], 'token 是必須的');
    }

    function login(Request $request)
    {
        $email    = $request->input('email');
        $password = $request->input('password');

        if (is_null($email) || is_null($password)) {
            return $this->bad_request([], 'email & password are required');
        }

        // return $this->ok([], 'ok');

        // return password_hash('user', null);
        $user = User::where('email', $email)->first();

        if (is_null($user)) {
            return $this->unauthorized([], 'email not found');
        }

        // $result = Hash::check($user->password, $user->password);
        $password_check = password_verify($password, $user->password);

        if (!$password_check) {
            return $this->unauthorized([], 'password error');
        }

        // Cache::clear();

        $token = Str::random(30);

        cache([$token => $user->id], now()->addMinutes(10));

        return $this->ok([
            // 'user' => $user
            'token' => $token
        ], '');
    }

    function token_check(Request $request): JsonResponse
    {
        // Cache::clear();
        $token = $request->input('token');
        $id    = cache($token);
        if ($id) {
            return $this->ok([
                // 'token' => $id
            ], 'token exist');
        } else {
            return $this->bad_request([], 'token not exist');
        }
    }
}

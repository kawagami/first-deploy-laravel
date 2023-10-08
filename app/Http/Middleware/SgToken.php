<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SgToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $authorizationHeader = $request->header('Authorization');

        if ($authorizationHeader) {
            // 使用空格分割 Authorization 头部，并获取第二部分
            $parts = explode(' ', $authorizationHeader);
            if (count($parts) === 2 && $parts[0] === 'Bearer') {
                $token = $parts[1]; // 这里是 Token 的部分
                $id = cache($token);
                if ($id) {
                    return $next($request);
                }
            }
        }

        return response()->json([
            'message' => 'Unauthorized',
        ], 401);
    }
}

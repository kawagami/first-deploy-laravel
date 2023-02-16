<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class GoogleController extends Controller
{
    public function gitRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function gitCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            // info(json_encode($user));
            $searchUser = User::where('google_id', $user->id)->first();
            if ($searchUser) {
                Auth::login($searchUser);
                return redirect('/home');
            } else {
                $gitUser = User::create([
                    'name' => $user->name ?? $user->nickname ?? $user->email,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'auth_type' => 'google',
                    'password' => encrypt($user->email)
                ]);
                Auth::login($gitUser);
                return redirect('/home');
            }
        } catch (Exception $e) {
            info($e);
            return redirect('/')->with('error', 'something wrong!');
            // return response('something wrong!', 400);
            // dd($e->getMessage());
        }
    }
}

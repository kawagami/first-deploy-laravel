<?php

namespace App\Repositories\Socialite;

use App\Models\User;
use App\Models\UserLogin;

class BaseRepository
{
    public $user;
    public $user_login;

    public function __construct(
        User $user,
        UserLogin $user_login
    ) {
        $this->user      = $user;
        $this->user_login = $user_login;
    }

    public function user_email_is_exists(string $email): ?User
    {
        return $this->user::where('email', $email)->with('user_logins')->first();
    }

    public function user_has_same_auth_type(User $user, string $auth_type): ?UserLogin
    {
        return $user->user_logins()->firstWhere('auth_type', $auth_type);
    }

    public function create_user(array $data): User
    {
        return $this->user::create($data);
    }

    public function create_auth(array $data): UserLogin
    {
        return $this->user_login::create($data);
    }

    public function user_add_auth(User $user, UserLogin $user_login): void
    {
        $user->user_logins()->save($user_login);
    }
}

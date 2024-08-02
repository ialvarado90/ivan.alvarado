<?php

namespace App\Services;

use App\Contracts\UserTokenServiceInterface;
use App\Models\User;

class UserTokenService implements UserTokenServiceInterface
{
    public function setToken(User $user)
    {
        return bin2hex(openssl_random_pseudo_bytes(5)) . md5(time()) . $user->id;
    }
}
<?php

namespace App\Repositories;

use App\Contracts\UserTokenRepositoryInterface;
use App\Models\UserToken;

class UserTokenRepository implements UserTokenRepositoryInterface
{
    public function create($data)
    {
        return UserToken::create($data);
    }

    public function deleteByUser($user_id)
    {
        return UserToken::where("users_id", $user_id)->delete();
    }

    public function deleteByToken($token)
    {
        return  UserToken::where("token", $token)->delete();
    }
}

<?php

namespace App\Contracts;

interface UserTokenRepositoryInterface
{
    public function create($data);
    public function deleteByUser($user_id);
    public function deleteByToken($token);
}

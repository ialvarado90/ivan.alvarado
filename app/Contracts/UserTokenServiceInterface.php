<?php
namespace App\Contracts;

use App\Models\User;

interface UserTokenServiceInterface
{
    public function setToken(User $user);
}
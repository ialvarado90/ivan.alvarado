<?php

namespace App\Contracts;

use App\Models\User;

interface UserServiceInterface
{
    public function login($data);
    public function logout($token);
    public function store($data);
    public function update(User $user, $data);
    public function edit($id);
    public function changePass(User $user, $data);
    public function getUserList($data);
}

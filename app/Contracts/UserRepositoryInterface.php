<?php

namespace App\Contracts;

use App\Models\User;

interface UserRepositoryInterface
{
    public function findByEmail($email);

    public function store($data);

    public function update(User $user, $data);

    public function edit($id);

    public function getAll();

    public function getAllByRol($rol_id);
}

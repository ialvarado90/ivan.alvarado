<?php

namespace App\Services;

use App\Contracts\UserRepositoryInterface;
use App\Contracts\UserServiceInterface;
use App\Contracts\UserTokenRepositoryInterface;
use App\Contracts\UserTokenServiceInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceInterface
{
    protected $userRepository;
    protected $userTokenService;
    protected $userTokenRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        UserTokenServiceInterface $userTokenService,
        UserTokenRepositoryInterface $userTokenRepository
    ) {
        $this->userRepository = $userRepository;
        $this->userTokenService = $userTokenService;
        $this->userTokenRepository = $userTokenRepository;
    }

    public function login($data)
    {
        //Buscar existencia de email
        $user = $this->userRepository->findByEmail($data['email']);
        if (is_null($user)) {
            return false;
        }

        if (!Hash::check($data['password'], $user->password)) {
            return false;
        }

        //Borrar token existente por usuario
        $this->userTokenRepository->deleteByUser($user->id);

        //Generar token
        $token = $this->userTokenService->setToken($user);

        //Registrar sesion usuario / token
        $data_token = array("users_id" => $user->id, "token" => $token);
        $this->userTokenRepository->create($data_token);

        return $token;
    }

    public function logout($token)
    {
        //Borrar token cerrar sesion
        return $this->userTokenRepository->deleteByToken($token);
    }

    public function store($data)
    {
        $arr_data = [
            "cod" => $data["cod"],
            "nombre" => $data["nombre"],
            "email" => $data["email"],
            "telefono" => $data["telefono"],
            "puesto" => $data["puesto"],
            "rol_id" => $data["rol_id"],
            "password" => Hash::make($data["password"]),
        ];
        return $this->userRepository->store($arr_data);
    }

    public function update(User $user, $data)
    {
        $arr_data = [
            "cod" => $data["cod"],
            "nombre" => $data["nombre"],
            "email" => $data["email"],
            "telefono" => $data["telefono"],
            "puesto" => $data["puesto"],
            "rol_id" => $data["rol_id"],
        ];

        //Actualizar password si esta en lleno
        if (isset($data["password"]) && $data["password"] != "") {
            $arr_data["password"] = Hash::make($data["password"]);
        }
        return $this->userRepository->update($user, $arr_data);
    }

    public function changePass(User $user, $data)
    {
        //Campos a actualizar
        $arr_data = [
            "password" => Hash::make($data["password"]),
        ];
        return $this->userRepository->update($user, $arr_data);
    }

    public function edit($id)
    {
        return $this->userRepository->edit($id);
    }

    public function getUserList($data)
    {
        if (isset($data["rol_id"]) && $data["rol_id"] != "") {
            return $this->userRepository->getAllByRol($data["rol_id"]);
        } else {
            return $this->userRepository->getAll();
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Contracts\RolesServiceInterface;
use App\Contracts\UserServiceInterface;
use App\Http\Requests\UserChangePassRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;
    protected $rolesService;

    public function __construct(UserServiceInterface $userService, RolesServiceInterface $rolesService)
    {
        $this->userService = $userService;
        $this->rolesService = $rolesService;
    }

    public function login(UserLoginRequest $request)
    {
        //Valida las credenciales y obtiene token de sesion
        $token = $this->userService->login($request->validated());

        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json(['token' => $token]);
    }

    public function logout(Request $request)
    {
        try {
            $token = $request["token"];
            // Lógica para cerrar sesion usuario
            $user_token = $this->userService->logout($token);
            if (!$user_token) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
            return response()->json(['message' => 'Se cerró la sesión.'], 200);
        } catch (\Exception $e) {
            // Manejo del error
            return response()->json([
                'error' => 'Error',
                'message' => 'Se ha presentado un error, intente más tarde.'
            ], 500);
        }

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function create()
    {
        //Obtener lista de roles y mostrarlo en el formulario
        $roles = $this->rolesService->getRoles();
        return response()->json(['roles' => $roles]);
    }

    public function store(UserStoreRequest $request)
    {
        try {
            // Lógica para crear el nuevo registro usuario
            $user = $this->userService->store($request->validated());
            return response()->json(['message' => 'Se registró usuario.'], 201);
        } catch (\Exception $e) {
            // Manejo del error
            return response()->json([
                'error' => 'Error',
                'message' => 'Se ha presentado un error, intente más tarde.'
            ], 500);
        }
    }

    public function changePass(UserChangePassRequest $request)
    {
        try {
            $user = $request["user"];
            // Lógica para cambiar password usuario
            $user = $this->userService->changePass($user, $request->validated());
            return response()->json(['message' => 'Se actualizó password.'], 200);
        } catch (\Exception $e) {
            // Manejo del error
            return response()->json([
                'error' => 'Error',
                'message' => 'Se ha presentado un error, intente más tarde.'
            ], 500);
        }
    }

    public function edit($id)
    {
        //Buscar usuario
        $user = $this->userService->edit($id);
        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        //Obtener lista de roles y mostrarlo en el formulario
        $roles = $this->rolesService->getRoles();
        return response()->json(["user" => $user, "roles" => $roles]);
    }

    public function update(UserUpdateRequest $request, $id)
    {
        try {
            //Buscar usuario
            $user = $this->userService->edit($id);
            if (!$user) {
                return response()->json(['error' => 'Usuario no encontrado'], 404);
            }

            // Lógica para actualizar usuario
            $user = $this->userService->update($user, $request->validated());
            return response()->json([
                'message' => 'Se actualizó usuario.'
            ], 200);
        } catch (\Exception $e) {
            // Manejo del error
            return response()->json([
                'error' => 'Error',
                'message' => 'Se ha presentado un error, intente más tarde.'
            ], 500);
        }
    }

    public function datatable(Request $request)
    {
        //Obtener lista de usuarios y mostrarlo en el datatable
        $users = $this->userService->getDatatable($request);
        return response()->json($users);
    }
}

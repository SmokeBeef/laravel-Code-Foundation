<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserCreateRequest;
use App\Http\Requests\User\UserLoginRequest;
use App\Models\User;
use App\Service\User\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    public function __construct(
        private UserService $userService,
    ) {}


    public function login(UserLoginRequest $req)
    {
        $payload = $req->validated();

        $token = auth()->attempt($payload);
        if (!$token) {
            return response()->json([
                "error" => "Unautorized"
            ], 401);
        }
        return response()->json([
            "message" => "success login",
            "data" => [
                "token" => $token
            ]
        ]);
    }
    public function register(UserCreateRequest $req)
    {
        $payload = $req->validated();

        $this->userService->createOne($payload);

        return response()->json([
            "message" => "success create user",
        ], 201);
    }

    public function getAll()
    {
        $users = $this->userService->getAll();
        return response()->json([
            "message" => "success",
            "data" => $users
        ]);
    }
    public function logout()
    {
        auth()->logout();
        return response()->json([
            "message" => "success logout"
        ]);
    }
    public function refreshToken()
    {
        $token = auth()->refresh();
        return response()->json([
            "message" => "success",
            "data" => [
                "token" => $token
            ]
        ]);

    }

    // public function createManyAuto()
    // {
    //     $users = $this->userService->createManyAuto();
    //     return response()->json([
    //         "message" => "success",
    //         "data" => $users
    //     ], 201);
    // }


}

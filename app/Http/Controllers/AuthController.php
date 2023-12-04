<?php

namespace App\Http\Controllers;

use App\Dto\User\UserCreateDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Jobs\User\InsertManyData;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    protected $authService;
    public function __construct(
        AuthService $authService,
    ) {
        $this->authService = $authService;
    }


    public function login(UserRequest $req)
    {
        // dd($req);
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
    public function register(UserRequest $req)
    {
        $payload = $req->validated();

        $user = $this->authService->createOne($payload);

        return response()->json([
            "message" => "success create user",
            "data" => $user
        ], 201);
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

    public function createManyAuto()
    {
        InsertManyData::dispatch();
        return response()->json([
            "message" => "success",
        ], 201);
    }


}

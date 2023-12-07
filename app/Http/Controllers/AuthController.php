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
            return $this->responseError("email or password not sign", 401);
        }
        return $this->responseSuccess("Success Login", ["token" => $token]);
    }
    public function register(UserRequest $req)
    {
        $payload = $req->validated();

        $user = $this->authService->createOne($payload);

        return $this->responseSuccess("Success Register", $user, 201);
    }


    public function logout()
    {
        auth()->logout();
        return $this->responseSuccess("Success Logout", );
    }

    public function refreshToken()
    {
        $token = auth()->refresh();
        return $this->responseSuccess("Success Get RefreshToken", ["token" => $token]);

    }

    public function createManyAuto()
    {
        InsertManyData::dispatch();
        return $this->responseSuccess("Success Create Many");
    }


}

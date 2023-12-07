<?php

namespace App\Http\Controllers;

use App\Dto\User\UserCreateDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;

use App\Jobs\InsertManyData;
use App\Models\User;
use App\Services\AuthService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Queue\Connectors\DatabaseConnector;
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
        try {
            $payload = $req->validated();
            $this->authService->findByEmail($payload["email"]);
            $token = auth()->attempt($payload);
            if (!$token) {
                return $this->responseError("email or password not sign", 401);
            }
            return $this->responseSuccess("Success Login", ["token" => $token]);

        } catch (Exception $err) {
            return $this->responseError("Sorry, there was an error on the Server Side", 500);
        }
    }
    public function register(UserRequest $req)
    {
        try {
            $payload = $req->validated();

            $user = $this->authService->createOne($payload);

            return $this->responseSuccess("Success Register", $user, 201);

        } catch (Exception $err) {
            return $this->responseError("Sorry, there was an error on the Server Side", 500);
        }
    }


    public function logout()
    {
        try {

            auth()->logout();
            return $this->responseSuccess("Success Logout", );
        } catch (Exception $err) {
            return $this->responseError("Sorry, there was an error on the Server Side", 500);
        }
    }

    public function refreshToken()
    {
        try {

            $token = auth()->refresh();
            return $this->responseSuccess("Success Get RefreshToken", ["token" => $token]);
        } catch (Exception $err) {
            return $this->responseError("Sorry, there was an error on the Server Side", 500);
        }

    }

    public function createManyAuto()
    {
        InsertManyData::dispatch();
        return $this->responseSuccess("Success Create Many");
    }


}

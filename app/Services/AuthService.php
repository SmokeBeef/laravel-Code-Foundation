<?php

namespace App\Services;

use App\Repositories\AuthRepository;
use Exception;

class AuthService
{

    private $authRepository;
    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }
    public function createOne($data)
    {
        return $this->authRepository->createOne($data);
    }
    public function findByEmail(string $email)
    {
        return $this->authRepository->findByEmail($email); 
    }
}
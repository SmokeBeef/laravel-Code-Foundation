<?php

namespace App\Repositories;

use App\Models\User;
use Exception;

class AuthRepository
{
    protected $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function createOne($data)
    {
        $user = $this->user::create($data);
        return $user;
    }
    public function findByEmail($email)
    {
        return $this->user->where("email", $email)->first();
    }
}
<?php

namespace App\Service\User;

use App\Models\User;
use App\Repositories\User\UserRepositories;

class UserService {

    public function __construct(
        private UserRepositories $userRepositories
    )
    {
    }

    public function createOne($data)
    {
        $user = $this->userRepositories->createOne($data);
        return $user;
    }
    public function updateByid($id, $data)
    {
        $user = $this->userRepositories->updateByid($id, $data);
        return $user;
    }
    public function getAll()
    {
        return $this->userRepositories->findAll();
    }
    // public function createManyAuto()
    // {
    //     return $this->userRepositories->createMany();
    // }
}
<?php

namespace App\Service\User;

use App\Models\User;
use App\Repository\User\UserRepository;


class UserService
{

    protected $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createOne($data)
    {
        $user = $this->userRepository->createOne($data);
        return $user;
    }
    public function updateByid($id, $data)
    {
        $user = $this->userRepository->updateByid($id, $data);
        return $user;
    }
    public function getAll($limit = 10, $offset = 0)
    {
        return $this->userRepository->findAll($limit, $offset);
    }
    public function createManyAuto()
    {
        return $this->userRepository->createMany();
    }
}
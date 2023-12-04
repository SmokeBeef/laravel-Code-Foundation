<?php

namespace App\Services\Admin;
use App\Repositories\Admin\UserRepository;




class UserService
{

    protected $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllPaginate($offset = 0, $limit = 10)
    {
        return $this->userRepository->findAllPaginate($offset, $limit);
    }

    public function deleteById($id)
    {
        $admin = $this->userRepository->deleteById($id);
        return $admin;
    }
}
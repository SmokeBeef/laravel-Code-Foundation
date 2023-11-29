<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Support\Facades\Redis;

class UserRepositories
{

    protected $userRediskey;
    public function __construct(
        private readonly User $user
    ) {
        $this->userRediskey = "user";
    }

    // public function createMany() // for create many users
    // {
    //     $users = $this->user::count();
    //     for ($i = 1; $i <= 1000; $i++) {
    //         $this->user::create([
    //             "name" => "John",
    //             "email" => "deva" . $i + $users . "@gmail.com",
    //             "password" => "123",
    //             "role" => "admin"
    //         ]);
    //     }
    //     return null;
    // }

    public function createOne($data)
    {
        $user = $this->user::create($data);
        return $user;
    }

    public function updateByid($id, $data)
    {
        $user = $this->user::find($id);
        $user->update($data);
        return $user;
    }

    public function findAll()
    {
        $users = Redis::get($this->userRediskey);
        if ($users) {
            return json_decode($users);
        }
        $users = $this->user::all();
        Redis::set($this->userRediskey, json_encode($users), "EX", 5);
        return $users;
    }
}
<?php

namespace App\Repository\User;

use App\Models\User;
use Illuminate\Support\Facades\Redis;

class UserRepository
{

    protected $userRediskey;
    protected $user;
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->userRediskey = "user";
    }

    public function createMany() // for create many users
    {
        $users = $this->user::count();
        $usersManyPayload = [];
        for ($i = 1; $i <= 100000; $i++) {
            array_push($usersManyPayload, [
                "name" => "John",
                "email" => "deva" . $i + $users . "@gmail.com",
                "password" => "123",
                "role" => "admin"
            ]);
        }
        $this->user::insert($usersManyPayload);
        return null;
    }

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

    public function findAll($limit, $offset)
    {
        // $users = Redis::get($this->userRediskey);
        // if ($users) {
        //     return json_decode($users);
        // }
        $users = $this->user::limit($limit)->offset($offset)->get();
        // Redis::set($this->userRediskey, json_encode($users), "EX", 5);
        return $users;
    }
}
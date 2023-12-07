<?php

namespace App\Repositories\Admin;

use App\Models\User;
use Exception;
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
    

    public function findAllPaginate($offset, $limit)
    {
        // $users = Redis::get($this->userRediskey);
        // if ($users) {
        //     return json_decode($users);
        // }
        $users = $this->user::limit($limit)->offset($offset)->get();
        // Redis::set($this->userRediskey, json_encode($users), "EX", 5);
        return $users;
    }
    public function count()
    {
        return $this->user::count();
    }
    public function deleteById($id)
    {
        $user = $this->user::find($id);
        $user->delete();
        return $user;
    }
}
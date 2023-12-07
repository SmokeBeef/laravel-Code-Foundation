<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\UserMiddleware;
use App\Services\Admin\UserService;

use Illuminate\Http\Request;

class UserController extends Controller
{

    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->middleware(['admin_only']);
        $this->userService = $userService;
    }

    public function getAll(Request $req)
    {
        $page = $req->query("page", 1);
        $perPage = $req->query("limit", 10);
        $offset = $perPage * ($page - 1);

        $users = $this->userService->getAllPaginate($offset, $perPage);

        $totalUsers = $this->userService->count();
        $meta = $this->metaPagination($totalUsers, $perPage, $page);
        return $this->responsePagination("Success Get All Users", $users, $meta)
        ;
    }
    public function delete($id)
    {
        $user = $this->userService->deleteById($id);
        return $this->responseSuccess("Success Delete user id " . $id, $user);
    }
}

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
        return response()->json([
            "message" => "success",
            "data" => $users
        ]);
    }
    public function deleteById($id)
    {
        $this->userService->deleteById($id);
        return response()->json([
            "message" => "success delete user id " . $id,
        ]);
    }
}

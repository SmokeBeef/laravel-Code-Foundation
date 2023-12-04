<?php

namespace App\Http\Controllers;

use App\Services\ItemService;
use Illuminate\Http\Request;


class ItemController extends Controller
{
    protected $itemService;
    public function __construct(ItemService $itemService)
    {
        $this->itemService = $itemService;
    }


    public function getAllPaginate(Request $req)
    {
        $page = $req->query("page", 1);
        $perPage = $req->query("limit", 10);
        $offset = $perPage * ($page - 1);

        $items = $this->itemService->getAllPagination($offset, $perPage);
        $totalItems = $this->itemService->total();

        return response()->json([
            "message" => "message",
            "data" => $items,
            "meta" => [
                "total" => $totalItems,
            ]
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Services\ItemService;
use Exception;
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
        try {

            $page = $req->query("page", 1);
            $perPage = $req->query("limit", 10);
            $offset = $perPage * ($page - 1);

            $items = $this->itemService->getAllPagination($offset, $perPage);
            $totalItems = $this->itemService->total();

            $meta = $this->metaPagination($totalItems, $perPage, $page);

            return $this->responsePagination("Success Get Item", $items, $meta);
        } catch (Exception $err) {
            return $this->responseError("Sorry, there was an error on the Server Side");
        }
    }
}

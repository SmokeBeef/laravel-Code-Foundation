<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Http\Middleware\JwtMiddleware;
use App\Http\Requests\ItemRequest;
use App\Services\Resepsionis\ItemService;

class ItemController extends Controller
{
    protected $itemService;
    public function __construct(ItemService $itemService)
    {
        $this->middleware([JwtMiddleware::class,"resepsionis_only"]);
        $this->itemService = $itemService;
    }

    public function create(ItemRequest $req)
    {
        $payload = $req->validated();

        $item = $this->itemService->createOne($payload);
        return response()->json([
            "message" => "success create item",
            "data" => $item,
        ], 201);
    }
}

<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Http\Middleware\JwtMiddleware;
use App\Http\Requests\ItemRequest;
use App\Services\Resepsionis\ItemService;
use Exception;

class ItemController extends Controller
{
    protected $itemService;
    public function __construct(ItemService $itemService)
    {
        $this->middleware(["jwt", "resepsionis_only"]);
        $this->itemService = $itemService;
    }

    public function create(ItemRequest $req)
    {
        try {
            $payload = $req->validated();

            $item = $this->itemService->createOne($payload);
            return $this->responseSuccess("Success create item", $item, 201);
        } catch (Exception $err) {
            return $this->responseError("Sorry, there was an error on the Server Side", 500);
        }
    }
    public function update(ItemRequest $req, $id)
    {
        try {
            $payload = $req->validated();
            $item = $this->itemService->updateOne($id, $payload);

            if (!$item) {
                return $this->responseError("id item " . $id . " Not found", 404);
            }
            return $this->responseSuccess("Success create item", $item, 201);
        } catch (Exception $err) {
            return $this->responseError("Sorry, there was an error on the Server Side", 500);
        }
    }
    public function destroy($id)
    {
        try {
            $item = $this->itemService->deleteOne($id);
            if (!$item) {
                return $this->responseError("id item " . $id . " Not found", 404);
            }
            return $this->responseSuccess("Success create item", $item);
        } catch (Exception $err) {
            return $this->responseError("Sorry, there was an error on the Server Side", 500);
        }
    }
}
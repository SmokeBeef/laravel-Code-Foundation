<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function paginate(string $message, $data, int $totalData, int $perPage)
    {
        return response()->json([
            "message" => $message,
            "data" => $data,
            "meta" => [
                "total" => $totalData
            ]
        ]);
    }
}

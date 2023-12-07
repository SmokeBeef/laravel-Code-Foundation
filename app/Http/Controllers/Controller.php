<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    // response function
    protected function responsePagination(string $message, $data, array $meta, int $code = 200)
    {
        return response()->json([
            "code" => $code,
            "message" => $message,
            "datas" => $data,
            "meta" => $meta,
        ], $code);
    }
    protected function responseSuccess(string $message, mixed $data = null, int $code = 200)
    {
        return response()->json([
            "code" => $code,
            "message" => $message,
            "data" => $data
        ], $code);
    }
    protected function responseError(string $message, int $code = 500, $data = null)
    {
        return response()->json([
            "code" => $code,
            "message" => $message,
            "data" => $data
        ], $code);
    }


    // additional function
    protected function metaPagination(int $totalData, int $perPage, int $currentPage)
    {
        return [
            "totalData" => $totalData,
            "perPage" => $perPage,
            "currentPage" => $currentPage,
            "totalPage" => ceil($totalData / $perPage)
        ];
    }

}

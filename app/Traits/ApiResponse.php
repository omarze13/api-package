<?php

namespace App\Traits;

use Illuminate\Contracts\Support\MessageBag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

trait ApiResponse
{
    function sendResponse(int $code = 200, string|null $msg = '', array|JsonResource|MessageBag $data = []) : JsonResponse|Response
    {
        $response = [
            'status' => $code,
            'message' => $msg,
            'data' => $data
        ];

        return response()->json($response, $code);
    }
}

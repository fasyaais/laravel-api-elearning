<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait ApiResponse {
    protected function successResponse($data = null, string $message = 'OK', int $statusCode = Response::HTTP_OK): JsonResponse{
        $response = [
            "success" => true,
            "message"=>$message
        ];

        if($data){
            $response["data"] = $data;
        }

        return response()->json($response,$statusCode);
    }

    protected function errorResponse(string $message,int $statusCode = Response::HTTP_NOT_FOUND,$error = null): JsonResponse{
        $response = [
            "success" => false,
            "message"=>$message
        ];

        if($error){
            $response["error"] = $error;
        }

        return response()->json($response,$statusCode);
    }
}

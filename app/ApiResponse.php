<?php

namespace App;

trait ApiResponse
{
    public function successResponse(string $message, $data = [], $pagination = null)
    {
        $response = [
            'meta' => [
                'success' => true,
                'message' => $message,
                'error_code' => null,
            ],
            'data' => $data,
        ];

        if ($pagination) {
            $response['pagination'] = $pagination;
        }

        return response()->json($response, 200);
    }

    public function errorResponse(string $message, int $errorCode, $statusCode = 400)
    {
        return response()->json([
            'meta' => [
                'success' => false,
                'message' => $message,
                'error_code' => $errorCode,
            ],
            'data' => [],
        ], $statusCode);
    }
}

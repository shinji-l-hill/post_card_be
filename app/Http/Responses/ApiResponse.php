<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;

class ApiResponse
{
    public static function success(mixed $output, $message = null): JsonResponse
    {
        return response()->json(
            [
                "success" => true,
                "message" => $message,
                "output" => $output,
            ],
            200,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE
        );
    }

    public static function failed(string $message, array $errors = null, int $status = 401): JsonResponse
    {
        return response()->json(
            [
                "success" => false,
                "message" => $message,
                "errors" => $errors,
            ],
            $status,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE
        );
    }
}

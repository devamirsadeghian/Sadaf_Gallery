<?php

namespace App\Traits;

trait ApiResponse {
    public static function success(string $message = null, mixed $data = null , int $status = 200) {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data'    => $data,
        ], $status);
    }

    public static function error($message = null, $status = 400) {
        return response()->json([
            'success' => false,
            'message' => $message,
        ], $status);
    }
}


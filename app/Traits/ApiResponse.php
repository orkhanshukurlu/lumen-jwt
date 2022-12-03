<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    private string $success = 'OK';
    private string $error   = 'ERROR';

    public function respondError(string $message, $data, int $code = 400): JsonResponse
    {
        return $this->respond($this->error, $message, $code, $data);
    }

    public function respondMessage(string $message, int $code): JsonResponse
    {
        return $this->respond($this->error, $message, $code);
    }

    public function respondSuccess(string $message, $data, int $code = 200): JsonResponse
    {
        return $this->respond($this->success, $message, $code, $data);
    }

    public function respondToken(string $message, $data, string $token, int $code = 200): JsonResponse
    {
        return $this->respond($this->success, $message, $code, $data, ['token' => $token]);
    }

    private function respond(string $status, string $message, int $code, $data = false, ?array $appends = []): JsonResponse
    {
        $response = ['status' => $status, 'message' => $message];

        if ($data)    $response = array_merge($response, $data);
        if ($appends) $response = array_merge($response, $appends);

        return response()->json($response, $code);
    }
}

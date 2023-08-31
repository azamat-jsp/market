<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Symfony\Component\HttpFoundation\Response;

class ErrorResponse implements Responsable
{
    public function __construct(
        private readonly string $message,
        private readonly int    $status
    )
    {
    }

    public function toResponse($request): Response
    {
        return response([
            'success' => false,
            'message' => $this->message
        ], $this->status);
    }
}

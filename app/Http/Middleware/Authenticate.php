<?php

namespace App\Http\Middleware;

use App\Traits\ApiResponse;
use Closure;
use Illuminate\Http\Request;

class Authenticate
{
    use ApiResponse;

    public function handle(Request $request, Closure $next): mixed
    {
        if (auth()->guest()) {
            return $this->respondMessage('Unauthorized', 401);
        }

        return $next($request);
    }
}

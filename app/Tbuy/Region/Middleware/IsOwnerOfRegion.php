<?php

namespace App\Tbuy\Region\Middleware;

use Closure;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class IsOwnerOfRegion
{
    public function handle($request, Closure $next)
    {
        if ($request->region->user_id !== $request->user()->id) {
            throw new AccessDeniedHttpException('Access Denied');
        }

        return $next($request);
    }
}

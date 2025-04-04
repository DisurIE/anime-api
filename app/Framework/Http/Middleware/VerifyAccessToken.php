<?php

declare(strict_types=1);

namespace App\Framework\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;

class VerifyAccessToken
{
    /**
     * @throws AuthenticationException
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $accessToken = $request->header('Access-Token');

        if (!$accessToken || $accessToken !== config('auth.access_token')) {
            throw new AuthenticationException();
        }

        return $next($request);
    }
}

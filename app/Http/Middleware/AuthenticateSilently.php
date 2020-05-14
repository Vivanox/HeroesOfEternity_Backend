<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate;

class AuthenticateSilently extends Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[] ...$guard
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $result = null;

        try {
            $result = parent::handle($request, $next, ...$guards);
        } catch (AuthenticationException $e) {
            //
        }

        return $result ?? $next($request);
    }
}

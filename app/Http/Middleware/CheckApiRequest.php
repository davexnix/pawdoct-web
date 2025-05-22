<?php

namespace App\Http\Middleware;

use App\Http\Middleware\Api\ForceJsonRequest;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckApiRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->is('api/*')) {
            return (new ForceJsonRequest())->handle($request, $next);
        }

        return $next($request);
    }
}

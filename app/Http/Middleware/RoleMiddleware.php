<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use PhpParser\Node\Scalar\String_;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role, string $role2 = null): Response
    {
        if (strcmp($request->user()->role, $role) != 0 && ($role2 != null && strcmp($request->user()->role, $role2) != 0)){
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}

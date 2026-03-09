<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!$request->user()) {
            return redirect('/login');
        }

        if ($request->user()->role !== $role) {
            abort(403);
        }

        return $next($request);
    }
}
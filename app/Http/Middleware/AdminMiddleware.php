<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     * Redirect non-admin users away from admin routes.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user() || ! $request->user()->isAdmin()) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Unauthorized. Admin access required.'], 403);
            }

            auth()->logout();
            return redirect()->route('login')->with('error', 'You do not have admin privileges.');
        }

        return $next($request);
    }
}

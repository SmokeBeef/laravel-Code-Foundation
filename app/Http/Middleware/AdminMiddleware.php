<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $payload = json_decode($request->headers->get("payload"));
        
        if (!isset($payload->role) || $payload->role !== "admin") {
            return response()->json([
                "error" => "Only Admin can Access this",
            ], Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}

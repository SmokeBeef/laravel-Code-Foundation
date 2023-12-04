<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ResepsionisMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $payload = json_decode($request->headers->get("payload"));
        
        if (!isset($payload->role) || $payload->role !== "resepsionis") {
            return response()->json([
                "error" => "You do not have access to this feature as a resepsionis.",
            ], Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}

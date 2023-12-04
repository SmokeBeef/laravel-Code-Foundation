<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $token = JWTAuth::parseToken()->authenticate(); 
            $payload = JWTAuth::user();
            // dd($payload);
            $request->headers->set("payload", $payload);
        } catch (Exception $error) {
            if ($error instanceof TokenInvalidException) {
                return response()->json([
                    'error' => 'Token is Invalid'
                ], 401);
            } else if ($error instanceof TokenExpiredException) {
                return response()->json([
                    'error' => 'Token is Expired'
                ], 401);
            } else {
                return response()->json([
                    'error' => 'Token not found'
                ], 401);
            }
        }
        return $next($request);
    }
}

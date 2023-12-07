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
            return $this->response("only resepsionis can access this", Response::HTTP_FORBIDDEN);

        }

        return $next($request);
    }
    private function response(string $message, int $code = 200)
    {
        return response()->json([
            "code" => $code,
            "message" => $message,
            "data" => null
        ], $code);
    }
}

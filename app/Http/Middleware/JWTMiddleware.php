<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            if (!$user) {
                return response()->json(['message' => 'user not found'], 410);
            } else {
                // $token = JWTAuth::getToken();
                // $token_parts = explode('.', $token);
                // if (!empty($token_parts)) {
                //     $token_payload = $token_parts[1];
                //     $token_payload_json = base64_decode($token_payload);
                //     $token_payload_array = json_decode($token_payload_json, true);
                // }
                // return response()->json(['user' => $user, 'token' => $token_payload_array]);
            }
        } catch (JWTException $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json(['status' => 'Token is Invalid'], 410);
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json(['status' => 'Token is Expired'], 410);
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenBlacklistedException) {
                return response()->json(['status' => 'Token is Blacklisted'], 410);
            } else {
                return response()->json(['status' => 'Authorization Token not found'], 410);
            }
        }
        return $next($request);
    }
}

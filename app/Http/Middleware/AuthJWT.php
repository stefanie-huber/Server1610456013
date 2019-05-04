<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Exception;

class AuthJWT
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            //$user = JWTAuth::toUser($request->input('token'));
            if(!$user = JWTAuth::parseToken()->authenticate()){
                return response()->json(['error' => 'Invalid token']);
            }
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json(['error' => 'Invalid token.']);
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json(['error' => 'Expired token.']);
            } else {
                return response()->json(['error' => 'Authentication error.']);
            }
        }
        return $next($request);
    }
}

//nimmt den call entgegen - handle methode
//toUser vom jwtAuth aufrufen
//der token muss mitgegeben werden
//token wird aufgelöst
//ist user gültig, dann passts
//mit $next leite ich alles weiter an die richtige Stelle
//wenn kein gültiger user ist, bricht's ab
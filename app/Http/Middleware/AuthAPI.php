<?php

namespace App\Http\Middleware;

use App\Models\Auth;

use Closure;
use Illuminate\Http\Request;

class AuthAPI
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // verify if header has authorization info to auth
        if (!$request->hasHeader('Authorization')) {
            return response()->json(['error' => 'Unauthorized access.', 'error_code' => 'MAuthAPI001'], 401);
        }
        // get bearer token
        $JWT = $request->bearerToken();
        // verify if jwt is a valid token
        if (!Auth::isValidToken($JWT)){
            return response()->json(['error' => 'Unauthorized access.', 'error_code' => 'MAuthAPI002'], 401);
        }
        return $next($request);
    }
}

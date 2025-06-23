<?php

namespace App\Http\Middleware;

use App\Traits\ApiResponse;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CekRole
{
    use ApiResponse;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if(!Auth::check()){
            return $this->errorResponse("Unauthenticeted",Response::HTTP_UNAUTHORIZED);
        }
        $user = Auth::user();
        if(!in_array($user->role,$roles)){
            return $this->errorResponse("You don't have permission",Response::HTTP_FORBIDDEN);
        }
        return $next($request);
    }
}

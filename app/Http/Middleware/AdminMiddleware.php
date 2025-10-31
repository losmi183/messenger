<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\JWTServices;

class AdminMiddleware
{
    private JWTServices $jwtServices;

    public function __construct(JWTServices $jwtServices) {
        $this->jwtServices = $jwtServices;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $this->jwtServices->getContent();

        if($user['role'] != 'admin') {
            abort(403, 'Only admin role can access this route');
        }

        return $next($request);
    }
}

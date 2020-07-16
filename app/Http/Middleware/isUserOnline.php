<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class isUserOnline
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Carbon::parse(time())->diffInMinutes(Auth::user()->updated_at) > 5)
            $user = Auth::user()->touch();
        
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;

class setReferral
{
    public function handle($request, Closure $next)
    {
        $week = Carbon::now()->subWeek()->diffInMinutes(Carbon::now(), false);
        if ($request->isMethod('get') && $request->ref != null && $request->cookie('ref') == null) {
            $cookie = cookie('ref', $request->ref, $week);
            return $next($request)->cookie($cookie);
        }
        
        return $next($request);
    }
}

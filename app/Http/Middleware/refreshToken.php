<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;

class refreshToken
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && $request->cookie('token') === null && url()->current() != 'https://klaufshop.ru/vk')
            return redirect('https://oauth.vk.com/authorize?client_id=7264964&display=page&redirect_uri=https://klaufshop.ru/vk&scope=groups&response_type=code&v=5.103');

        return $next($request);
    }
}

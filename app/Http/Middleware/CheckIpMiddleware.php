<?php

namespace App\Http\Middleware;

use Closure;

class CheckIpMiddleware
{

    public $whiteIps = ['203.116.32.82','::1'];
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){ $public_ip = $_SERVER['HTTP_CLIENT_IP']; }
        if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){ $public_ip = $_SERVER['HTTP_X_FORWARDED_FOR']; }
        if(!empty($_SERVER['HTTP_X_FORWARDED'])){ $public_ip = $_SERVER['HTTP_X_FORWARDED']; }
        if(!empty($_SERVER['HTTP_FORWARDED_FOR'])){ $public_ip = $_SERVER['HTTP_FORWARDED_FOR']; }
        if(!empty($_SERVER['HTTP_FORWARDED'])){ $public_ip = $_SERVER['HTTP_FORWARDED']; }
        if(!empty($_SERVER['REMOTE_ADDR'])){ $public_ip = $_SERVER['REMOTE_ADDR']; }
        if (!in_array($public_ip, $this->whiteIps)) {
            return response()->view('errors.error');
        }
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class loginJwt
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
        if($jwt = $request->cookie('jwt')){
            $request->headers->set('Authorization','Bearer '. $jwt);  ///added to set jwt bearer in header 
        }

        //$this->authenticate($request, $guards);
        return $next($request);
    }

}

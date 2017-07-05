<?php

namespace App\Http\Middleware;

use Closure;
use Request;

class CheckToken
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
        $all_headers = Request::header('Authorization');
        if($all_headers){
            return $next($request);
        }else{
            return redirect('home');
        }
        
    }
}

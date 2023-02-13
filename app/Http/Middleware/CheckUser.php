<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUser
{

    public function handle(Request $request, Closure $next)
    {
        if(Auth()->user()->type == 'user'){
            return $next($request);
        }
        return redirect()->back();
     }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdmin
{

    public function handle(Request $request, Closure $next)
    {

        if(Auth()->user()->type == 'admin'){
            return $next($request);
        }
        return redirect()->back();

    }
}

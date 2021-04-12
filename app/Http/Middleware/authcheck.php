<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class authcheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (session()->has('admin_logged')==false)
        {
            $request->session()->flash("invalidauth","success");    
            return redirect('/admin');
        }
        return $next($request);
    }
}

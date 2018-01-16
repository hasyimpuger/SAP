<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Gudang
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
        if (Auth::user()->level == 'gudang' || Auth::user()->level == 'admin') {
            return $next($request);
        }
        return redirect()->back()->with('error', 'Maaf Akses ditolak !');
    }
}

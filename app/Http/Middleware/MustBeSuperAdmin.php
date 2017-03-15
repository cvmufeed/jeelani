<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class MustBeSuperAdmin
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
        if (Auth::check()) {
            if ($request->user()->type != 'superadmin') {
                return back()->with('error','Must be Super Admin to do this task');
            }
        }
        else {
            return redirect('/login');
        }
        return $next($request);
    }
}

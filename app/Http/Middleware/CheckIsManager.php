<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckIsManager
{
    /**
     * Handle an incoming request and checks in logged user has client access
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if (!auth()->user()) {
            return redirect('/')->with('error','You are not logged');
        }
        if (!auth()->user()->can(ACCESS_MANAGER_LABEL)) {
            return redirect('/')->with('error','You have no manager access');
        }
        return $next($request);
    }
}

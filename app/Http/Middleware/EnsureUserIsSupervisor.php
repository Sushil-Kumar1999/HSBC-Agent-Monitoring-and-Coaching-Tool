<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsSupervisor
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
        $role = Auth::user()->role;

        if ($role != 'Supervisor') {
            if($role == 'Admin'){
                return redirect()->route('admin.index')->with('message','You are not authorized to access supervisor dashboard');
            }
            if($role == 'Agent'){
                return redirect()->route('agentdashboard.show')->with('message','You are not authorized to access supervisor dashboard');
            }
            return redirect()->route('login')->with('message', 'Something went wrong with your request');
        }

        return $next($request);
    }
}

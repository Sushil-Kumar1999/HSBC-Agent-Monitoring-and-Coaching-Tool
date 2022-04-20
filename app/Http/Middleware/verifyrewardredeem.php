<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reward;

class VerifyRewardRedeem
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
        $r = Reward::findOrFail($request->reward);
        $page = ($r->type=="skillbuilder")?"skillbuilderTab":"rewardsTab";
        if(Auth::user()->id != $r->psid){
            return redirect('agentdashboard')->with('message','Something went wrong when redeeming your reward.')->with('page',$page);
        }
        if($r->redeemed){
            return redirect('agentdashboard')->with('message','You have already redeemed this reward.')->with('page',$page);
        }
        return $next($request);
    }
}

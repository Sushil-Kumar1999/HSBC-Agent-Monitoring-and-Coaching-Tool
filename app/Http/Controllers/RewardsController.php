<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reward;

class RewardsController extends Controller
{
    /**
     * redeems a reward
     */
    
    public function redeem(Reward  $request ,$id)
    {
        $reward = Reward::find($id);
        $reward->redeemed = true;
        $reward->save();
        $page = ($reward->type=="skillbuilder")?"skillbuilderTab":"rewardsTab";
        $message = ($reward->type=="skillbuilder")?"Skillbuilder marked as complete.":"Reward succesfully redeemed.";
        return redirect()->route('agentdashboard.show')->with('message',$message)->with('page',$page);
    }

    public function store(Request $request)
    {

    }
}

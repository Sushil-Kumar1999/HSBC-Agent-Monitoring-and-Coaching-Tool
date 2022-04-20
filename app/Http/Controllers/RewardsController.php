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
        return redirect('agentdashboard')->with('message',$message)->with('page',$page);
    }

    //rewards?agentId=1&type=Reward
    public function apiIndex(Request $request)
    {
        $agentId = $request->input('agentId');
        $type = $request->input('skillbuilder');
        $query = Reward::query();

        if($agentId)
        {
            $query->where('psid', $agentId);
        }

        if ($type)
        {
            $query->where('type', $type);
        }

        return $query->get();
    }
}

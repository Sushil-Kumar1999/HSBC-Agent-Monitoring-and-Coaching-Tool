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

    //rewards?agentId=1&type=Reward
    public function apiIndex(Request $request)
    {
        $agentId = $request->input('agentId');
        $type = $request->input('type');
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


    public function store(Request $request)
    {
        $reward = new Reward();
        $reward->psid = $request->input('agentId');
        $reward->supervisor_id = $request->input('supervisorId');
        $reward->type = $request->input('type');
        $reward->title = $request->input('title');
        $reward->content = $request->input('content');
        $reward->redeemed = false;
        $reward->save();

        $resource = $request->input('type') == "reward" ? "Reward" : "Skill builder";

        return response($resource . " created successfully", 201);
    }

    public function apiDelete(Reward $reward)
    {
        $reward->delete();

        return response('Reward deleted successfully', 200);
    }
}

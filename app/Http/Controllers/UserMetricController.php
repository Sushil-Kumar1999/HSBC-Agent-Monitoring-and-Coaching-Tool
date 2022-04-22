<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\UserMetric;
use Illuminate\Http\Request;

class UserMetricController extends Controller
{
    public function apiStore(Request $request, $userId)
    {
        $metric = new UserMetric();
        $metric->psid = $request->input('agentId');
        $metric->site = $request->input('site');
        $metric->timestamp = time();
        $metric->ccpoh = $request->input('ccpoh');
        $metric->art = $request->input('art');
        $metric->nps = $request->input('nps');
        $metric->fcr = $request->input('fcr');
        $metric->online_percentage = $request->input('onlinePercentage');
        // TODO: Calculate qualifier
        $metric->qualifier = "Medium";
        $metric->save();

        return response('User metric created successfully', 201);
    }
}

<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>

@extends('layouts.navigationbar')

@section('content')

<link rel="stylesheet" href="{{asset('css/splitviewdashboard.css') }}">
{{-- <link rel="stylesheet" href="{{asset('css/rewardviewer.css') }}"> --}}
<link rel="stylesheet" href="{{asset('css/supervisordashboard.css') }}">

<section id="root" class="container hsbc-red">

    <div id="col-1">
        <h1 style="font-size: medium;">Agents in Team {{$user->team->name}}</h1>

        <div class="left-pane">

            @php
                $agents = Auth::user()->team->members->toQuery()
                         ->with('metrics')->with('rewards')->where('role', 'Agent')->get();
            @endphp
            <table style="width: 100%">
                <thead>
                    <tr class="table-row">
                        <th>PSID</th>
                        <th>Agent Name</th>
                        <th>Qualifier</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($agents as $agent)
                    @php
                        $qualifier = $agent->metrics->toQuery()->orderBy('created_at', 'DESC')->first()->qualifier;
                    @endphp
                    <tr @class(['table-row',
                                'agent-bg-red' => $qualifier == "Low",
                                'agent-bg-amber' => $qualifier == "Medium",
                                'agent-bg-green' => $qualifier == "Good"])
                        onclick="onAgentClicked({!! $agent->id !!})">
                        <td>{{ $agent->id }}</td>
                        <td>{{ $agent->name }}</td>
                        <td>{{ $qualifier }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="button-container">
                <button onclick="onViewMetricsClicked()">View Metrics</button>
                <button v-on:click="onViewRewardsClicked()">View Rewards</button>
                <button>View Skill Builders</button>
            </div>
        </div>
    </div>

    <div id="col-2">
        <h1 id="right-pane-title" style="font-size: medium;">No agent selected</h1>

        <div class="right-pane">
            <ul id="metrics-list" style="display: none">
                <li id="ccpoh"></li>
                <li id="art"></li>
                <li id="nps"></li>
                <li id="fcr"></li>
                <li id="online_percentage"></li>
            </ul>

            <div id="rewards-list" style="display: none">
                <div v-for="reward in rewards" class="reward-item">
                    <div>@{{ reward.title }}</div>
                    <div>@{{ reward.content }}</div>
                    <div>@{{ reward.redeemed  ? 'Reward completed' : 'Reward not completed' }}
                </div>
            </div>


        </div>
    </div>

</section>

<script>
    var app = new Vue({
        el: "#root",
        data: {
            rewards: [],
        },
        methods: {
            getRewards: function() {
                axios.get(`/api/rewards?agentId=${selectedAgent.id}&type=reward`)
                .then(response => {
                    this.rewards = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
            },
            onViewRewardsClicked: function() {
                hideAll();
                document.getElementById('rewards-list').style.display = "block";
                document.getElementById('right-pane-title').textContent = `Viewing rewards for ${selectedAgent.name} (Agent ${selectedAgent.id})`;
                this.getRewards();
            }
        }
    });
</script>

@endsection

<script>
    var agents = {{ Js::from($agents) }};
    var selectedAgent;

    function hideAll()
    {
        document.getElementById('metrics-list').style.display = "none";
        document.getElementById('rewards-list').style.display = "none";
    }

    function onAgentClicked(id) {
       selectedAgent = agents.find(ag => ag.id == id);
    }

    function onViewMetricsClicked() {
        hideAll();
        document.getElementById('metrics-list').style.display = "block";

        var metric = selectedAgent.metrics[selectedAgent.metrics.length - 1];
        document.getElementById('right-pane-title').textContent = `Viewing metrics for ${selectedAgent.name} (Agent ${selectedAgent.id})`;
        document.getElementById('ccpoh').textContent = `CCPOH: ${metric.ccpoh}`;
        document.getElementById('art').textContent = `ART: ${metric.art}`;
        document.getElementById('nps').textContent = `NPS: ${metric.nps}`;
        document.getElementById('fcr').textContent = `FCR: ${metric.fcr}`;
        document.getElementById('online_percentage').textContent = `Online Percentage: ${metric.online_percentage}`;
    }

    // function onViewRewardsClicked() {
    //     hideAll();
    //     document.getElementById('rewards-list').style.display = "block";
    //     document.getElementById('right-pane-title').textContent = `Viewing rewards for ${selectedAgent.name} (Agent ${selectedAgent.id})`;
    // }


</script>

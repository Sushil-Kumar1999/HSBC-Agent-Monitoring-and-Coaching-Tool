<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>

@extends('layouts.navigationbar')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">>

@section('content')
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="dA6hUZXf43T4RjxrQdvQUSnWfvKuOZVMjP9enwoX">

    <title>Supervisor Dashboard</title>


    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&amp;display=swap">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
    crossorigin="anonymous">


    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{asset('css/agentdashboard.css') }}">
    <link rel="stylesheet" href="{{asset('css/splitviewdashboard.css') }}">
    <link rel="stylesheet" href="{{asset('css/supervisordashboard.css') }}">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"" defer=""></script>

</head>

<body class="font-sans antialiased">
    <nav class="navbar fixed-top navbar-expand-md navbar-dark shadow-sm" id="nav">
        <div class="container-fluid position-relative">
            <img src="img/hsbc.png" href="{{ route('supervisordashboard.show') }}" style="width: 50px; height: 50px" >

            <a class="nav-link link-light me-auto" aria-current="page" href="{{ route('supervisordashboard.show') }}">
            Supervisor Dashboard
            </a>

            <a id="navText "class="text-white position-absolute top-50 start-50 translate-middle">
                HSBC Agent Monitoring and Coaching Tool
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <div class="relative" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
                    <div @click="open = ! open">
                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div id="dropdown">{{ Auth::user()->name }}

                            </div>

                            <div class="ml-1">
                                <svg id="dropdown" class="fill-current h-4 w-4 " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </button>
                    </div>

                    <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute z-50 mt-2 w-48 rounded-md shadow-lg origin-top-right right-0" style="display: none;" @click="open = false">
                        <div class="rounded-md ring-1 ring-black ring-opacity-5 py-1 bg-white">
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    this.closest('form').submit();">Log Out</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    <a class="block pl-3 pr-4 py-2 border-l-4 border-indigo-400 text-base font-medium text-indigo-700 bg-indigo-50 focus:outline-none focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700 transition duration-150 ease-in-out" href="{{ route('supervisordashboard.show') }}">
                            Supervisor Dashboard
                    </a>
                </div>

                <!-- Responsive Settings Options -->
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="px-4">
                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            <input type="hidden" name="_token" value="dA6hUZXf43T4RjxrQdvQUSnWfvKuOZVMjP9enwoX">
                            <a class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    Log Out
                            </a>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </nav>




    <main>
        <div class="mt-4 pt-3 ">
            <section id="root" class="container ">

                    <div id="col-1">
                        <h1 style="font-size: medium;">Agents List</h1>

                        <div class="left-pane">
                            <label class="ext-normal text-black">Choose Team: </label>
                            <select v-on:change="onTeamSelected($event)" class="form-select">
                                <option value="0">All</option>
                                <option v-for="team in teams" :value="team.team_id">@{{ team.name }}</option>
                            </select>

                            <table v-if="agents.length!=0" style="width: 100%;">
                                <thead>
                                    <tr class="mt-4 table-row">
                                        <th>PSID</th>
                                        <th>Agent Name</th>
                                        <th>Qualifier</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="agent in agents" class=" mt-2 table-row" :class="getAgentColors(getLatestMetric(agent))"
                                        v-on:click="onAgentClicked(agent.id)">
                                        <td class="pl-1" >@{{ agent.id }}</td>
                                        <td>@{{ agent.name }}</td>
                                        <td class="pr-1" >@{{ getLatestMetric(agent).qualifier }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="pagination-container">
                                <span v-on:click="getPrevPage()"> << Prev </span>
                                <span id="page">Page @{{ page }}</span>
                                <span v-on:click="getNextPage()"> Next >> </span>
                            </div>

                            <p id="agent-selected-message" class="fs-5 fw-bold text-black text-center pt-3 mt-3 mb-3 text-uppercase">No agent selected </p>

                            <div class="btn-toolbar button-container " role="group" >
                                <button id="viewButton" type="button" class="btn btn-dark mx-auto" v-on:click="onViewMetricsClicked()">View Metrics</button>
                                <button id="viewButton" type="button" class="btn btn-dark mx-auto"  v-on:click="onViewRewardsClicked()">View Rewards</button>
                                <button id="viewButton" type="button" class="btn btn-dark mx-auto" v-on:click="onViewSkillbuildersClicked()">View Skill Builders</button>
                                <button id="viewButton" type="button" class="btn btn-dark mx-auto" v-on:click="onAssignRewardClicked()">Assign Reward</button>
                                <button id="viewButton" type="button" class="btn btn-dark mx-auto" v-on:click="onAssignSkillBuilderClicked()">Assign Skill Builder</button>
                                <button id="viewButton" type="button" class="btn btn-dark mx-auto" v-on:click="onViewTeamClicked()">View Team</button>
                            </div>
                        </div>
                    </div>

                    <div id="col-2">
                        <h1 id="right-pane-title" style="font-size: medium;">No agent selected</h1>

                        <div class="right-pane">
                            <div id="metrics-list" style="display: none">
                                <ul class="pl-0 ml-0  ">
                                    <li id="ccpoh" class="mb-2"></li>
                                    <li id="art" class="mb-2"></li>
                                    <li id="nps" class="mb-2" ></li>
                                    <li id="fcr" class="mb-2" ></li>
                                    <li id="online_percentage" class="mb-2"></li>
                                </ul>

                                <button  id="button" class="mx-auto update-metric-toggle text-white btn border-0 btn-success" v-on:click="showUpdateForm=!showUpdateForm" >
                                    Update
                                </button>

                                <div id="update-metric-form" class="update-metric-form" v-if="showUpdateForm">
                                    <div class="form-group mt-3">
                                        <label>CCPOH: </label>
                                        <input id="update-ccpoh" type="number" step="any" min="0"></input>
                                    </div>

                                    <div class="form-group">
                                        <label>ART: </label>
                                        <input id="update-art" type="number" step="any" min="0"></input>
                                    </div>

                                    <div class="form-group">
                                        <label>NPS: </label>
                                        <input id="update-nps" type="number" step="any" min="0"></input>
                                    </div>

                                    <div class="form-group">
                                        <label>FCR: </label>
                                        <input id="update-fcr" type="number" step="any" min="0"></input>
                                    </div>

                                    <div class="form-group">
                                        <label>Online Percentage: </label>
                                        <input id="update-online-percentage" type="number" step="any" min="0"></input>
                                    </div>

                                    <button v-on:click="onUpdateMetricClicked()" class="text-white btn border-0 btn-success">Update</button>
                                </div>
                            </div>


                            <div id="rewards-list" style="display: none">
                                <div v-for="reward in rewards" class="reward-item">
                                    <div>@{{ reward.title }}</div>
                                    <div>@{{ reward.content }}</div>
                                    <div>@{{ reward.redeemed  ? 'Reward completed' : 'Reward not completed' }}</div>
                                    <button v-on:click="onRemoveRewardClicked(reward.id)">Remove</button>
                                </div>
                            </div>

                            <div id="skillbuilders-list" style="display: none">
                                <div v-for="skillbuilder in skillbuilders" class="reward-item">
                                    <div>@{{ skillbuilder.title }}</div>
                                    <div>@{{ skillbuilder.content }}</div>
                                    <div>@{{ skillbuilder.redeemed  ? 'Skill builder completed' : 'Skill builder not completed' }}</div>
                                </div>
                            </div>

                            <div id="create-reward-form" class="form-flex" style="display: none">
                                <label for="reward-title">Reward Title</label>
                                <input id="reward-title" type="text" name="title"></input>

                                <label for="reward-content">Reward Content:</label>
                                <textarea id="reward-content" rows="5" name="content"></textarea>

                                <div class="submit-button-container">
                                    <button v-on:click="onCreateRewardClicked()">Create Reward</button>
                                </div>

                                <p id="reward-success-message" style="color: green; display: none"></p>
                            </div>

                            <div id="create-skillbuilder-form" class="form-flex" style="display: none">
                                <label for="skillbuilder-title">Skill Builder Title</label>
                                <input id="skillbuilder-title" type="text" name="title"></input>

                                <label for="skillbuilder-content">Skill Builder Content:</label>
                                <textarea id="skillbuilder-content" rows="5" name="content"></textarea>

                                <div class="submit-button-container">
                                    <button v-on:click="onCreateSkillBuilderClicked()">Create Skill Builder</button>
                                </div>

                                <p id="skillbuilder-success-message" style="color: green; display: none"></p>
                            </div>

                            <div id="view-team" style="display: none">
                                <span id="team-message"></span>
                            </div>

                            <div id="add-to-team" style="display: none">
                                <label>Choose team: </label>
                                <select id="team-dropdown">
                                    <option v-for="team in teams" :value="team.team_id">@{{ team.name }}</option>
                                </select>
                                <button v-on:click="onAssignTeamClicked()">Assign team</button>
                                <p id="add-to-team-message" style="color: green; display: none"></p>
                            </div>

                            <div id="remove-from-team" style="display: none">
                                <span>Remove agent from current team</span>
                                <button v-on:click="removeAgentFromTeam()">Remove</button>
                                <p id="remove-from-team-message" style="color: green; display: none"></p>
                            </div>

                        </div>
                    </div>

            </section>

            <script>
                    var app = new Vue({
                        el: "#root",
                        data: {
                            page: 1,
                            agents: [],
                            selectedAgent: null,
                            rewards: [],
                            skillbuilders: [],
                            teams: [],
                            showUpdateForm: false
                        },
                        mounted() {
                            this.getAgents();
                            this.getTeams();
                        },
                        methods: {
                            getLatestMetric: function(agent) {
                                return agent.metrics[agent.metrics.length - 1];
                            },
                            getAgentColors: function(metric) {
                                return { 'agent-bg-red': metric.qualifier == "Low",
                                        'agent-bg-amber': metric.qualifier == "Medium",
                                        'agent-bg-green': metric.qualifier == "Good"
                                }
                            },
                            getPrevPage: function() {
                                if (this.page <= 1) return;
                                this.page -= 1;
                                this.getAgents();
                            },
                            getNextPage: function() {
                                this.page += 1;
                                this.getAgents();
                            },
                            getTeams: function() {
                                axios.get('/api/teams')
                                .then(response => {
                                    this.teams = response.data;
                                })
                                .catch(error => {
                                    console.log(error);
                                });
                            },
                            getAgents: function(teamId = 0) {
                                var baseUrl = `/api/users?role=Agent&page=${this.page}`;
                                var param = teamId == 0 ? '' : `&teamId=${teamId}`;
                                axios.get(baseUrl + param)
                                .then(response => {
                                    this.agents = response.data;
                                })
                                .catch(error => {
                                    console.log(error);
                                });
                            },
                            getRewards: function() {
                                axios.get(`/api/rewards?agentId=${this.selectedAgent.id}&type=reward`)
                                .then(response => {
                                    this.rewards = response.data;
                                })
                                .catch(error => {
                                    console.log(error);
                                });
                            },
                            getSkillbuilders: function() {
                                axios.get(`/api/rewards?agentId=${this.selectedAgent.id}&type=skillbuilder`)
                                .then(response => {
                                    this.skillbuilders = response.data;
                                })
                                .catch(error => {
                                    console.log(error);
                                });
                            },
                            createReward: function(reward) {
                                axios.post('/api/rewards', reward)
                                .then(response => {
                                    document.getElementById('reward-success-message').style.display = "block";
                                    document.getElementById('reward-success-message').textContent = response.data;
                                    document.getElementById("reward-title").value = '';
                                    document.getElementById("reward-content").value = '';
                                })
                                .catch(error => {
                                    console.log(error);
                                });
                            },
                            createSkillBuilder: function(skillbuilder) {
                                axios.post('/api/rewards', skillbuilder)
                                .then(response => {
                                    document.getElementById('skillbuilder-success-message').style.display = "block";
                                    document.getElementById('skillbuilder-success-message').textContent = response.data;
                                    document.getElementById("skillbuilder-title").value = '';
                                    document.getElementById("skillbuilder-content").value = '';
                                })
                                .catch(error => {
                                    console.log(error);
                                });
                            },
                            removeAgentFromTeam: function() {
                                axios.put(`/api/users/${this.selectedAgent.id}/removeFromTeam`)
                                .then(response => {
                                    document.getElementById('remove-from-team-message').style.display = "block";
                                    document.getElementById('remove-from-team-message').textContent = response.data;
                                    this.getAgents();
                                })
                                .catch(error => {
                                    console.log(error);
                                });
                            },
                            addAgentToTeam: function(teamId) {
                                axios.put(`/api/users/${this.selectedAgent.id}/addToTeam`, { teamId : teamId } )
                                .then(response => {
                                    document.getElementById('add-to-team-message').style.display = "block";
                                    document.getElementById('add-to-team-message').textContent = response.data;
                                    this.getAgents();
                                })
                                .catch(error => {
                                    console.log(error);
                                });
                            },
                            deleteReward: function(rewardId) {
                                axios.delete(`/api/rewards/${rewardId}`)
                                    .then(() => {
                                        var index = this.rewards.findIndex(reward => reward.id == rewardId);
                                        this.rewards.splice(index, 1);
                                    })
                                    .catch(error => {
                                        console.log(error);
                                    });
                            },
                            createUserMetric: function(metric) {
                                axios.post(`/api/users/${this.selectedAgent.id}/usermetrics`, metric)
                                    .then(response => {
                                        alert(response.data);
                                        this.getAgents();
                                    })
                                    .catch(error => {
                                        console.log(error);
                                    });
                            },
                            onAgentClicked: function(id) {
                                this.selectedAgent = this.agents.find(ag => ag.id == id);
                                document.getElementById('agent-selected-message').textContent = `Agent ${this.selectedAgent.name} (PSID ${this.selectedAgent.id}) selected`;
                            },
                            onViewMetricsClicked: function() {
                                hideAll();
                                document.getElementById('metrics-list').style.display = "block";

                                var metric = this.selectedAgent.metrics[this.selectedAgent.metrics.length - 1];
                                document.getElementById('right-pane-title').textContent = `Viewing metrics for ${this.selectedAgent.name} (PSID ${this.selectedAgent.id})`;
                                document.getElementById('ccpoh').textContent = `CCPOH: ${metric.ccpoh}`;
                                document.getElementById('art').textContent = `ART: ${metric.art}`;
                                document.getElementById('nps').textContent = `NPS: ${metric.nps}`;
                                document.getElementById('fcr').textContent = `FCR: ${metric.fcr}`;
                                document.getElementById('online_percentage').textContent = `Online Percentage: ${metric.online_percentage}`;
                            },
                            onViewRewardsClicked: function() {
                                hideAll();
                                document.getElementById('rewards-list').style.display = "block";
                                document.getElementById('right-pane-title').textContent = `Viewing rewards for ${this.selectedAgent.name} (PSID ${this.selectedAgent.id})`;
                                this.getRewards();
                            },
                            onViewSkillbuildersClicked: function() {
                                hideAll();
                                document.getElementById('skillbuilders-list').style.display = "block";
                                document.getElementById('right-pane-title').textContent = `Viewing skill builders for ${this.selectedAgent.name} (PSID ${this.selectedAgent.id})`;
                                this.getSkillbuilders();
                            },
                            onAssignRewardClicked: function() {
                                hideAll();
                                document.getElementById('create-reward-form').style.display = "flex";
                                document.getElementById('right-pane-title').textContent = `Creating reward for ${this.selectedAgent.name} (PSID ${this.selectedAgent.id})`;
                            },
                            onAssignSkillBuilderClicked: function() {
                                hideAll();
                                document.getElementById('create-skillbuilder-form').style.display = "flex";
                                document.getElementById('right-pane-title').textContent = `Creating skill builder for ${this.selectedAgent.name} (PSID ${this.selectedAgent.id})`;
                            },
                            onViewTeamClicked: function() {
                                hideAll();
                                document.getElementById('view-team').style.display = "block";
                                document.getElementById('right-pane-title').textContent = `Viewing team for ${this.selectedAgent.name} (PSID ${this.selectedAgent.id})`;

                                if (this.selectedAgent.team == null)
                                {
                                    document.getElementById('team-message').textContent = `${this.selectedAgent.name} is not assigned to any team`;
                                    document.getElementById("add-to-team").style.display = "block";
                                }
                                else
                                {
                                    document.getElementById('team-message').textContent = `${this.selectedAgent.name} is assigned to Team ${this.selectedAgent.team.name}`;
                                    document.getElementById("remove-from-team").style.display = "block";
                                }

                            },
                            onCreateRewardClicked: function() {
                                var title = document.getElementById("reward-title").value;
                                var content = document.getElementById("reward-content").value;

                                var reward = {
                                    title: title,
                                    content: content,
                                    type: 'reward',
                                    agentId: this.selectedAgent.id,
                                    supervisorId: supervisor.id
                                };
                                this.createReward(reward);
                            },
                            onCreateSkillBuilderClicked: function() {
                                var title = document.getElementById("skillbuilder-title").value;
                                var content = document.getElementById("skillbuilder-content").value;

                                var skillbuilder = {
                                    title: title,
                                    content: content,
                                    type: 'skillbuilder',
                                    agentId: this.selectedAgent.id,
                                    supervisorId: supervisor.id
                                };
                                this.createSkillBuilder(skillbuilder);
                            },
                            onAssignTeamClicked: function() {
                                var teamId = document.getElementById("team-dropdown").value;
                                this.addAgentToTeam(teamId);
                            },
                            onRemoveRewardClicked: function(rewardId) {
                                this.deleteReward(rewardId);
                            },
                            onUpdateMetricClicked: function() {
                                var metric =  {
                                    agentId: this.selectedAgent.id,
                                    site: this.selectedAgent.metrics[0].site,
                                    ccpoh: parseFloat(document.getElementById("update-ccpoh").value),
                                    art: parseFloat(document.getElementById("update-art").value),
                                    nps: parseFloat(document.getElementById("update-nps").value),
                                    fcr: parseFloat(document.getElementById("update-fcr").value),
                                    onlinePercentage: parseFloat(document.getElementById("update-online-percentage").value)
                                }
                                this.createUserMetric(metric);
                            },
                            onTeamSelected: function(event) {
                                this.getAgents(event.target.value);
                            }
                        }
                    });
                </script>

                @endsection

                <script>
                var supervisor = {{ Js::from($supervisor) }}

                function hideAll() {
                    document.getElementById('metrics-list').style.display = "none";
                    document.getElementById('rewards-list').style.display = "none";
                    document.getElementById('skillbuilders-list').style.display = "none";
                    document.getElementById('create-reward-form').style.display = "none";
                    document.getElementById('create-skillbuilder-form').style.display = "none";
                    document.getElementById('reward-success-message').style.display = "none";
                    document.getElementById('skillbuilder-success-message').style.display = "none";
                    document.getElementById('view-team').style.display = "none";
                    document.getElementById('add-to-team').style.display = "none"
                    document.getElementById('add-to-team-message').style.display = "none"
                    document.getElementById('remove-from-team').style.display = "none"
                    document.getElementById('remove-from-team-message').style.display = "none"
                }
                </script>

         </main>
    </div>

</body>
</html>






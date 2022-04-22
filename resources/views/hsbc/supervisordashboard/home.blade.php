<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>

@extends('layouts.navigationbar')

@section('content')

<link rel="stylesheet" href="{{asset('css/splitviewdashboard.css') }}">
<link rel="stylesheet" href="{{asset('css/supervisordashboard.css') }}">

<section id="root" class="container hsbc-red">

    <div id="col-1">
        <h1 style="font-size: medium;">Agents List</h1>

        <div class="left-pane">
            <table v-if="agents.length!=0" style="width: 100%;">
                <thead>
                    <tr class="table-row">
                        <th>PSID</th>
                        <th>Agent Name</th>
                        <th>Qualifier</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="agent in agents" class="table-row" :class="getAgentColors(getLatestMetric(agent))"
                        v-on:click="onAgentClicked(agent.id)">
                        <td>@{{ agent.id }}</td>
                        <td>@{{ agent.name }}</td>
                        <td>@{{ getLatestMetric(agent).qualifier }}</td>
                    </tr>
                </tbody>
            </table>

            <div class="pagination-container">
                <span v-on:click="getPrevPage()"> << Prev </span>
                <span id="page">Page @{{ page }}</span>
                <span v-on:click="getNextPage()"> Next >> </span>
            </div>

            <p id="agent-selected-message">No agent selected</p>

            <div class="button-container">
                <button v-on:click="onViewMetricsClicked()">View Metrics</button>
                <button v-on:click="onViewRewardsClicked()">View Rewards</button>
                <button v-on:click="onViewSkillbuildersClicked()">View Skill Builders</button>
                <button v-on:click="onAssignRewardClicked()">Assign Reward</button>
                <button v-on:click="onAssignSkillBuilderClicked()">Assign Skill Builder</button>
                <button v-on:click="onViewTeamClicked()">View Team</button>
            </div>
        </div>
    </div>

    <div id="col-2">
        <h1 id="right-pane-title" style="font-size: medium;">No agent selected</h1>

        <div class="right-pane">
            <div id="metrics-list" style="display: none">
                <ul>
                    <li id="ccpoh"></li>
                    <li id="art"></li>
                    <li id="nps"></li>
                    <li id="fcr"></li>
                    <li id="online_percentage"></li>
                </ul>

                <div class="update-metric-toggle" v-on:click="showUpdateForm=!showUpdateForm">Update</div>

                <div id="update-metric-form" class="update-metric-form" v-if="showUpdateForm">
                    <div class="form-group">
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

                    <button v-on:click="onUpdateMetricClicked()">Update</button>
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
            getAgents: function() {
                axios.get(`/api/users?role=Agent&page=${this.page}`)
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
                    this.getTeams();
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

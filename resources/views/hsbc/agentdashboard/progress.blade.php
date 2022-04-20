<div id="Progress" class="tabcontent">
  @php
  use App\Models\Team;
  $teams = Team::all();
  $topteam="A";
  $topteamScore = 0;
  @endphp
  <section class="container">
  <div id="col-1">
    <h1>Team scores</h1>
    <ul>
      <canvas id="teamCharts" width="50%" height="25%"></canvas>
    </ul>
    <script>
      var ctx = document.getElementById('teamCharts').getContext('2d');
      const teamCharts = new Chart(ctx, 
          {
              type: 'bar',
              data: {
                  labels: ["Team"],
                  datasets: [
                    @foreach($teams as $team)
                    @php
                    $teamScore = $team->score();
                    if($teamScore>$topteamScore){
                      $topteamScore=$teamScore;
                      $topteam=$team->name;
                    }
                    @endphp
                    {
                        label: 'Team {!!$team->name!!}',
                        data: [{!!$teamScore!!}],
                        borderColor:'{{$team==$user->team()->first()?"blue":"red"}}',
                        backgroundColor:'{{$team==$user->team()->first()?"blue":"red"}}',
                        showLine: true,
                        yAxisID: 'y',
                        hidden:false,
                    },
                    @endforeach
                  ]
                }
              }
      );
    </script>
    <h1>Team {{$topteam}} is in first position!</h1>
  </div>
  <div id="col-2">
  @php
     $team = $user->team()->first();
     $teamScore =$team->score();
     $score = $user->score();
  @endphp
  <h1>My score</h1>
    <ul>
     <canvas id="myTeamChart" width="50%" height="25%"></canvas>
     </ul>
     <script>
      var ctx = document.getElementById('myTeamChart').getContext('2d');
      const myTeamChart = new Chart(ctx, 
          {
              type: 'bar',
              data: {
                  labels: ["Team"],
                  datasets: [
                    {
                        label: 'Team {!!$team->name!!}',
                        data: [{!!$teamScore!!}],
                        borderColor:'red',
                        backgroundColor:'red',
                        showLine: true,
                        yAxisID: 'y',
                        hidden:false,
                    },
                    {
                        label: 'My score',
                        data: [{!!$score!!}],
                        borderColor:'blue',
                        backgroundColor:'blue',
                        showLine: true,
                        yAxisID: 'y',
                        hidden:false,
                    }
                  ]
                }
              }
      );
    </script>
    @if($teamScore>$score)
    <h1>Your score is below average within your team!</h1>
    @else
    <h1>Your score is above average within your team</h1>
    @endif
    
  </div>
  </section>
 </div>
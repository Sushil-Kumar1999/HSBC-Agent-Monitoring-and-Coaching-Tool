
<div id="Statistics" class="tabcontent">
 <section class="container">
 @php
  use App\Models\UserMetric;
  $metrics = $user->metrics()->take(30)->get();
  $latestmetric = null;
  if($metrics != null){
    $latestmetric = $metrics->last();
  }
  $times = array_map(
    function($item) {
      return gmdate("Y-m-d", $item);
    },
    $metrics->pluck('timestamp')->all()
  );
  $team = $user->team()->get()[0];
  $supervisor = $team->supervisor()->get()[0];
  
@endphp

  <div id="col-1">
    <h1>Statistics for {{$user->name}}</h1>
    <ul >
    @if (!is_null($latestmetric))
     <li>Site: {{$latestmetric->site,2}}</li>
     <li>Qualifier: {{$latestmetric->qualifier,2}}</li>
     <li>CCPOH: {{round($latestmetric->ccpoh,2)}}</li>
     <li>ART: {{round($latestmetric->art,2)}}</li>
     <li>NPS: {{round($latestmetric ->nps,2)}}%</li>
     <li>FCR: {{round($latestmetric->fcr,2)}}%</li>
     <li>Online Percentage: {{round($latestmetric ->online_percentage,2)}}%</li>
     <li>Score: {{round($user->score(),2)}}</li>
     <li>Team: {{$team->name}}</li>
     <li>Supervisor: {{$supervisor->name}} ({{$supervisor->id}})</li>
    @else
    <b>You do not have any metrics recorded</b>
    @endif
    </ul>
  </div>
  <div id="col-2">
    <h1>Personal Progress</h1>
    <ul>
      <script src="{{ asset('chart.js/chart.js')}}"></script>
        <canvas id="myProgress" width="50%" height="25%"></canvas>
        <script>
          var ctx = document.getElementById('myProgress').getContext('2d');
          var timestamps = {!! json_encode($times) !!};
          var ccpoh = {!! json_encode($metrics->pluck('ccpoh')->all()) !!};
          var art = {!! json_encode($metrics->pluck('art')->all()) !!};
          var nps = {!! json_encode($metrics->pluck('nps')->all()) !!};
          var fcr = {!! json_encode($metrics->pluck('fcr')->all()) !!};
          var online_percentage = {!! json_encode($metrics->pluck('online_percentage')->all()) !!};
          const newLegendClickHandler = function (e, legendItem, legend) {
          const index = legendItem.datasetIndex;
          const type = legend.chart.config.type;
          
          for (let i = 0; i < legend.chart.data.datasets.length; i++) {
            meta = legend.chart.getDatasetMeta(i);
            if(i==index){
              meta.hidden = false;
            }else{
              meta.hidden = true;
            }
          }
          getImproving(index);

          legend.chart.update();
        }

          const myChart = new Chart(ctx, 
          {
              type: 'line',
              data: {
                  labels: timestamps,
                  datasets: [
                    {
                      label: 'CCPOH',
                      data: ccpoh,
                      borderColor:'red',
                      backgroundColor:'red',
                      showLine: true,
                      yAxisID: 'y',
                      hidden:false,
                    },
                    {
                      label: 'ART',
                      data: art,
                      borderColor:'red',
                      backgroundColor:'red',
                      showLine: true,
                      yAxisID: 'y',
                      hidden:true,
                    },
                    {
                      label: 'NPS',
                      data: nps,
                      borderColor:'red',
                      backgroundColor:'red',
                      showLine: true,
                      yAxisID: 'y',
                      hidden:true,
                    },
                    {
                      label: 'FCR',
                      data: fcr,
                      borderColor:'red',
                      backgroundColor:'red',
                      showLine: true,
                      yAxisID: 'y',
                      hidden:true,
                    },
                    {
                      label: 'Online Percentage',
                      data: online_percentage,
                      borderColor:'red',
                      backgroundColor:'red',
                      showLine: true,
                      yAxisID: 'y',
                      hidden:true,
                    }
                  ]
              },
              options:{
                indexAxis: 'x',
                responsive: true,
                plugins: {
                  legend: {
                    onClick: newLegendClickHandler,
                    labels: {
                    color: "black",
                    font: {
                      size: 18
                    }
                  }
                  }
                }
              }
            }
          );
      </script>
      <h1 id='improvingText'></h1>

      <script>
        var improvingText = document.getElementById('improvingText');
        function getImproving(index){
          var stat;
          var statName;

          switch(index) {
            case 0:
              stat=ccpoh;
              statName="CCPOH";
              break;
            case 1:
              stat=art;
              statName="ART";
              break;
            case 2:
              stat=nps;
              statName="NPS";
              break;
            case 3:
              stat=fcr;
              statName="FCR";
              break;
            default:
              stat=online_percentage;
              statName="Online Percentage";
          }
          //traverses backwards through the past 4 entries and 
          //calculates the overall change in value
          stat = stat.slice(-4);
            var current = stat[stat.length-1];
            var diff=0;
            for(let i = stat.length-1; i >=0 ; i--){
              //for ART reverse 
              if(statName=="ART"){
                diff += stat[i]-current;
              }else{
                diff += current-stat[i];
              }
              current = stat[i];
            }
            improvingText.textContent = ("Your "+statName+" is " +(diff<0? "not":"")+" improving!");
          }
          getImproving(0);
      </script>
      </ul>
  </div>
</div>

<div id="Statistics" class="tabcontent">
 <section class="container">
 @php
  use App\Models\User;
  use App\Models\UserMetric;
  $metrics = $user->metrics()->get();
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
    @if (!is_null($latestmetric))
    <ul>
     <li>Site: {{$latestmetric->site}}</li>
     <li>Qualifier: {{$latestmetric->qualifier}}</li>
     <li>CCPOH: {{$latestmetric->ccpoh}}</li>
     <li>ART: {{$latestmetric->art}}</li>
     <li>NPS: {{$latestmetric ->nps}}</li>
     <li>FCR: {{$latestmetric->fcr}}</li>
     <li>Online Percentage: {{$latestmetric ->online_percentage}}</li>
     <li>Team: {{$team->name}}</li>
     <li>Supervisor: {{$supervisor->name}} ({{$supervisor->id}})</li>
    </ul>
    @else
    <b>No data loaded</b>
    @endif
  </div>
  <div id="col-2">
    <h1>Personal Progress</h1>
    <ul>
      <script src="{{ asset('chart.js/chart.js')}}"></script>
        <canvas id="myChart" width="500" height="200"></canvas>
        <script>
          var ctx = document.getElementById('myChart').getContext('2d');
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
          stat = stat.slice(4);
            var current = stat[0];
            var diff=0;
            for(let i = 0; i < stat.length; i++){
              diff += stat[i]-current;
              current = stat[i];
            }
            improvingText.textContent = ("Your "+statName+" is " +(diff<0? "not":"")+" improving!");
          }
          getImproving(0);
      </script>
      </ul>
  </div>
</div>
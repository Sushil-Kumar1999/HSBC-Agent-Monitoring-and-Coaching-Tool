
<div id="Statistics" class="tabcontent">
 <section class="container">
 @php
  use App\Models\User;
  use App\Models\UserMetric;
  $metrics = $user->metrics();
  $latestmetric = null;
  if($metrics != null){
    $latestmetric = $metrics->first();
  }
  $times = array_map(
    function($item) {
      return gmdate("Y-m-d", $item);
    },
    $metrics->pluck('timestamp')->all()
  );

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
     <li>Team: </li>
    </ul>
    @else
    <b>No data loaded</b>
    @endif
  </div>
  <div id="col-2">
    <h1>Graph</h1>
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
                    },
                    {
                      label: 'ART',
                      data: art,
                      borderColor:'red',
                      backgroundColor:'red',
                      showLine: true,
                      yAxisID: 'y',
                    },
                    {
                      label: 'NPS',
                      data: nps,
                      borderColor:'red',
                      backgroundColor:'red',
                      showLine: true,
                      yAxisID: 'y',
                    },
                    {
                      label: 'FCR',
                      data: fcr,
                      borderColor:'red',
                      backgroundColor:'red',
                      showLine: true,
                      yAxisID: 'y',
                    },
                    {
                      label: 'Online Percentage',
                      data: online_percentage,
                      borderColor:'red',
                      backgroundColor:'red',
                      showLine: true,
                      yAxisID: 'y',
                    }
                  ]
                }
            }
          );
      </script>
      </ul>
  </div>
</div>
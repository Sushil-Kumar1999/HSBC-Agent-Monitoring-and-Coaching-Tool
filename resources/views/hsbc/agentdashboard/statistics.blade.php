
<div id="Statistics" class="tabcontent">
 <section class="container">
 @php
  use App\Models\User;
  use App\Models\UserMetric;
  $metrics = $user->metrics();
  $latestmetric = null;
  if($metrics != null){
    $latestmetric = $metrics[0];
  }
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
     <li>Team: {{$user->team()->get()}}</li>
    </ul>
    @else
    <b>No data loaded</b>
    @endif
  </div>
  <div id="col-2">
    <h1>Graph</h1>
    <h2></h2>
  </div>
</div>
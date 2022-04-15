
<div id="Statistics" class="tabcontent">
 <section class="container">
 @php
  use App\Models\User;
  use App\Models\UserMetric;
  $user = User::findOrFail(1);
  @endphp
  <div id="col-1">
    <h1>Statistics for {{$user->name}}</h1>
    <ul>
     <li>Site:</li>
    </ul>
  </div>
  <div id="col-2">
    <h1>Graph</h1>
    <h2></h2>
  </div>
</div>
@extends('layouts.navigationbar')
<html>

@section('content')

<link rel="stylesheet" href="{{asset('css/splitviewdashboard.css') }}">
<link rel="stylesheet" href="{{asset('css/rewardviewer.css') }}">
@php
use App\Models\User;
use App\Models\Team;
if(session('page')){
  $page=session('page');
}else{
  $page="statisticsTab";
}
@endphp
<body>
 <div class="tab">
  <button class="tablinks" onclick="openTab(event, 'Statistics')" id="statisticsTab">Statistics</button>
  <button class="tablinks" onclick="openTab(event, 'Progress')" id="progressTab">Progress</button>
  <button class="tablinks" onclick="openTab(event, 'Rewards')" id="rewardsTab">Rewards</button>
  <button class="tablinks" onclick="openTab(event, 'SkillBuilder')" id="skillbuilderTab">Skill Builder</button>
 </div>

 @include('hsbc.agentdashboard.statistics')
 @include('hsbc.agentdashboard.progress')
 @include('hsbc.agentdashboard.rewards')
 @include('hsbc.agentdashboard.skillbuilder')

 <script>
  document.getElementById("{!!$page!!}").click();
  function openTab(evt, tabName) {
    var i, tabcontent, tablinks;  
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active"; 
  }
</script>
</body>
@endsection
</html>
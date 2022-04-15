<link rel="stylesheet" href="{{asset('css/hsbc.css') }}">
@extends('layouts.navigationbar')
<html>
@section('content')
<body>
 <div class="tab">
  <button class="tablinks" onclick="openTab(event, 'Statistics')" id="defaultOpen">Statistics</button>
  <button class="tablinks" onclick="openTab(event, 'Progress')">Progress</button>
  <button class="tablinks" onclick="openTab(event, 'Rewards')">Rewards</button>
  <button class="tablinks" onclick="openTab(event, 'SkillBuilder')">Skill Builder</button>
 </div>

 @include('hsbc.agentdashboard.statistics')
 @include('hsbc.agentdashboard.progress')
 @include('hsbc.agentdashboard.rewards')
 @include('hsbc.agentdashboard.skillbuilder')

 <script>
  document.getElementById("defaultOpen").click();
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
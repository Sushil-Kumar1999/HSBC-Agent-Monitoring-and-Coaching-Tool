<div id="SkillBuilder" class="tabcontent">
  <section class="container">
  <div id="col-1">
    <h1>Rewards</h1>
    @php
    $rewards = $user->skillbuilders()->get();
    @endphp
    @if(count($rewards)>0)
    
        @foreach($rewards as $reward)
        @php
        $supervisor = $reward->supervisor()->first();
        @endphp
        <div class = "reward">
          <div class = "content"><div class= "title">{{$reward->title}}{{$reward->redeemed?" (completed)":""}}</div><br>Given by {{$supervisor->name}} ({{$supervisor->id}})</div>
          <div class = "expandbutton"><input type="image" src="{{ asset('img/expand.png') }}" height="60px" width="60px" onClick=
          "onSkillbuilderExpand(
            {!! json_encode($reward->id) !!},
            '{!! htmlspecialchars($reward->title)!!}',
            '{!! htmlspecialchars($reward->content)!!}', 
            {!! json_encode($reward->redeemed) !!}
          )"/></div>
        </div>
        @endforeach
    
    @endif
  </div>
  <div id="col-2">
  <h1 id="skillbuilder-title">No Skillbuilder Selected</h1>
    <div class = "viewer" id="skillbuilder-viewer">
      <p>Please select a reward from the left side of the screen.</p>
   </div>
   @foreach($rewards as $reward)
   @if(!($reward->redeemed))
   <form method="POST" action="{{route('reward.redeem',['reward'=> $reward])}}" id = reward_{{$reward->id}}>
        @csrf
        @method('PUT')
        <input type="submit" value ="Mark as Completed">
    </form>
    <script>
      document.getElementById(('reward_'+{!!$reward->id!!})).style.visibility = "hidden";
    </script>
   @endif
   @endforeach
  </div>
 </div>
 <script>
   var previousSkillbuilder;
   function onSkillbuilderExpand(id, title, content, redeemed){
    var rewardTitle = document.getElementById('skillbuilder-title');
    var rewardContent = document.getElementById('skillbuilder-viewer');
    rewardTitle.textContent = title;
    rewardContent.textContent = content;
    if(previousSkillbuilder!=null){
        previousSkillbuilder.style.visibility = "hidden";
      }
    if(!redeemed){
      console.log(('reward_'+previousSkillbuilder));
      previousSkillbuilder=document.getElementById(('reward_'+id));
      previousSkillbuilder.style.visibility = "visible";
    }
   }
 </script>
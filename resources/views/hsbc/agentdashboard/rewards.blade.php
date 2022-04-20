<div id="Rewards" class="tabcontent">
  <section class="container">
  <div id="col-1">
    <h1>Rewards</h1>
    @php
    $rewards = $user->rewards()->get();
    @endphp
    @if(count($rewards)>0)
    <div class = "reward">
        @foreach($rewards as $reward)
        @php
        $supervisor = $reward->supervisor()->first();
        @endphp
          <div class = "content"><div class= "title">{{$reward->title}}{{$reward->redeemed?" (redeemed)":""}}</div><br>Given by {{$supervisor->name}} ({{$supervisor->id}})</div>
          <div class = "expandbutton"><input type="image" src="{{ asset('img/expand.png') }}" height="60px" width="60px" onClick=
          "onRewardExpand(
            {!! json_encode($reward->id) !!},
            '{!! htmlspecialchars($reward->title)!!}',
            '{!! htmlspecialchars($reward->content)!!}', 
            {!! json_encode($reward->redeemed) !!}
          )"/></div>
        @endforeach
    </div>
    @endif
  </div>
  <div id="col-2">
  <h1 id="reward-title">No Reward Selected</h1>
    <div class = "viewer" id="reward-viewer">
      <p>Please select a reward from the left side of the screen.</p>
   </div>
   @foreach($rewards as $reward)
   @if(!($reward->redeemed))
   <form method="POST" action="{{route('reward.redeem',['reward'=> $reward])}}" id = reward_{{$reward->id}}>
        @csrf
        @method('PUT')
        <input type="submit" value ="Redeem">
    </form>
    <script>
      document.getElementById(('reward_'+{!!$reward->id!!})).style.visibility = "hidden";
    </script>
   @endif
   @endforeach
  </div>
 </div>
 <script>
   var previousReward;
   function onRewardExpand(id, title, content, redeemed){
    var rewardTitle = document.getElementById('reward-title');
    var rewardContent = document.getElementById('reward-viewer');
    rewardTitle.textContent = title;
    rewardContent.textContent = content;
    //this method is really messy but it works
    if(previousReward!=null){
        previousReward.style.visibility = "hidden";
    }
    if(!redeemed){
      console.log(('reward_'+id));
      previousReward=document.getElementById(('reward_'+id));
      previousReward.style.visibility = "visible";
    }
   }
 </script>
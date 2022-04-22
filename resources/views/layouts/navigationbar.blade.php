<link rel="stylesheet" href="{{asset('css/hsbc.css') }}">
<html>
    <!--insert that thing that goes in the header of each page?-->
    <!-- <h1 class="navigationtitle">HSBC Agent Monitoring and Coaching tool</h1> -->
    @if(session('message'))
    <div id="overlay">
       
        <div id="messagebox"> 
            <input type="button" value=&#10006 style="float: right;" onclick="off()">
            <b><br><hr>{{session('message')}}</b></div>
    </div>
    @endif  
    @yield('content')
</html>
<script>
function off() {
  document.getElementById("overlay").style.display = "none";
}
</script>
@extends('layouts.user')
@section('content')
<script type="text/javascript">
/*
 window.onload = function() {
  var show = document.getElementById("show");
  setInterval(function() 
  {
   var time = new Date();
   // 程序计时的月从0开始取值后+1
   var m = time.getMonth() + 1;
   var d = time.getDate();
   var h = time.getHours();
   var mt= time.getMinutes();
   var ms = time.getSeconds();
   if(m<10)
   {m='0'+m;}
   if(d<10)
   {d='0'+d;}
   if(h<10)
   {h='0'+h;}
   if(mt<10)
   {mt='0'+mt;}
   if(ms<10)
   {ms='0'+ms;}
   var t = time.getFullYear() + "-" + m + "-" + d + " " + h + ":" + mt + ":" + ms;
   show.innerHTML = t;
  }, 1000);
 };
 */
</script>
<!--common-->
@endsection
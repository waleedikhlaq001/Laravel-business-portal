@extends('pages.app')
<link rel="stylesheet" href="{{asset('/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('/css/select2-bootstrap.min.css')}}">
<style>

    .form-group {
        transition: .5s;
    }

    .error {
        color: red;
        display: block;
        margin-top: .5rem;
    }

</style>
@section('content')
@include('includes.messages')
<script>

    function prepareData(){
        var urlParams = new URLSearchParams(window.location.search);
        var id = encodeURIComponent(urlParams.get('id'));
        return document.getElementById('vicom').contentWindow.postMessage({id, port: "{{ $port }}"},"*");
    }

</script>

<!-- <div>
  <div style="position:relative;padding-top:56.25%;">
    <iframe onload="prepareData()" id="vicom" src="http://localhost:3000/chat-frontend.html?vendor_id=0&influencer_id=0&mode=vendor" frameborder="0" allowfullscreen
      style="position:absolute;top:0;left:0;width:100%;height:100%;"></iframe>
  </div>
</div> -->

  <!-- Local Application -->
  <!-- <object id="vicom" data="http://localhost:3000/chat-frontend.html?vendor_id=0&influencer_id=0&mode=vendor" onload="prepareData()" width="100%" height="100%">
        <embed src="http://localhost:3000/chat-frontend.html?vendor_id=0&influencer_id=0&mode=vendor" onload="prepareData()" width="100%" height="100%"> </embed>
        Error: Embedded data could not be displayed.
  </object> -->


  <!-- Staging Heroku Application -->
  <object id="vicom" data="https://vicommadev-chat.herokuapp.com/chat-frontend.html?mode={{ $_GET['mode']}}" onload="prepareData()" width="100%" height="100%">
        <embed src="https://vicommadev-chat.herokuapp.com/chat-frontend.html?mode={{ $_GET['mode']}}" onload="prepareData()" width="100%" height="100%"> </embed>
  </object>


<!-- Heroku Staging Version -->
<!-- <iframe onload="prepareData()" id="vicom" src="https://vicommadev-chat.herokuapp.com/chat-frontend.html?vendor_id=0&influencer_id=0&mode=vendor" frameborder="0" allowfullscreen -->
@endsection   



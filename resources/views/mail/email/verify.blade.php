@extends('layouts.email')

@section('content')
<h1> Hi, {{$details['user']}} </h1>
<br>
<br>
{!!$details['message']!!}
<br>
<br>
When: <b>{{$details['time']}}</b>
<br>
<br>
Device: <b>{{$details['agent']}}</b>
<br>
<br>
Location: <b>{{$details['location']}}</b>
<br>
<div style="text-align: center; margin-top: 18px">
    <a href="{{ $details['url']}}" style="position: relative;
-webkit-text-size-adjust: none;
border-radius: 4px;
color: #fff;
display: inline-block;
/* overflow: hidden; */
text-decoration: none;
background-color: #94CA52;
border-bottom: 8px solid #94CA52;
border-left: 18px solid #94CA52;
border-right: 18px solid #94CA52;
border-top: 8px solid #94CA52;
border-radius: 33px;
padding: 7px 100px 7px 100px;
">Verify Email!</a>
</div>
<br>

Thank you,<br>
<p style="color: #6F3C96; font-weight: bold; font-size: 15px">{{ config('app.name') }}</p>
@endsection
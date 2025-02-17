@component('mail::message')
# Hello {{$details['user']}}
<br>
<br>
{{$details['message']}}
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
@if($details['user'])
<br>
User: <b>{{$details['user']}}</b>
<br>
@endif

Thank you,<br>
{{ config('app.name') }}
@endcomponent
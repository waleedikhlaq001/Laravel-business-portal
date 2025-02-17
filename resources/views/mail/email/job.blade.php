@component('mail::message')
# Hello! {{$details['user']}}
<br>
{{$details['message']}}
<br>
<br>
Here is your access token:
<br>
<h2>{{$details['token']}}</h2>
<br>
<br>
<br>
Thank you,<br>
{{ config('app.name') }}
@endcomponent
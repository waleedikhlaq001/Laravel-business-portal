@component('mail::message')
# Hello {{$details['user']}}
<br>
<br>
{{$details['message']}}
<br>
<br>
Name: <b>{{$details['name']}}</b>
<br>
<br>
Subject: <b>{{$details['subject']}}</b>
<br>
<br>
Email: <b>{{$details['email']}}</b>
<br>
<br>
Message: <b>{{$details['user_message']}}</b>
<br>
<br>


Thank you,<br>
{{ config('app.name') }}
@endcomponent
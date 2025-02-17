@component('mail::message')
# Hello! {{$details['user']}}

<br>
{{$details['message']}}
<br>
Thank you,<br>
{{ config('app.name') }}
@endcomponent
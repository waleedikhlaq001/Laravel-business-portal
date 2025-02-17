@component('mail::message')
# Hello! {{$details['user']}}
<br>
{{$details['message']}}


Thank you,<br>
{{ config('app.name') }}
@endcomponent
@component('mail::message')
{{-- # Hello {{$details['user']}} --}}
<br>
<br>
{{$details['message']}}
{{$details['token']}}
<br>
<br>

{{-- Thank you,<br> --}}
{{ config('app.name') }}
@endcomponent
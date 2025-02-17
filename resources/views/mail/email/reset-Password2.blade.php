@component('mail::message')
# Hello! {{$details['user']}}
<br>
@if ($details['action'] == 'successful')
{{$details['message']}}
<br>
support@vicomma.com
<br>
@else
{!! $details['message'] !!}
@endif


Thank you,<br>
{{ config('app.name') }}
@endcomponent
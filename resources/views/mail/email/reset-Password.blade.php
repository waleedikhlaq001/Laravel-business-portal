@component('mail::message')
# Hello! {{$details['user']}}
<br>
@if ($details['action'] == 'successful')
{{$details['message']}}
<br>
support@vicomma.com
<br>
@else
{{$details['message']}}
@component('mail::button', ['url' => $details['url'], 'color' => 'green'])
Reset password
@endcomponent
@endif


Thank you,<br>
{{ config('app.name') }}
@endcomponent
@component('mail::message')
# Hello! {{$details['user']}}
<br>
{{$details['message']}}

@component('mail::button', ['url' => $details['url'], 'color' => 'green'])
See Content Upload Guidelines
@endcomponent

Thank you,<br>
{{ config('app.name') }}
@endcomponent
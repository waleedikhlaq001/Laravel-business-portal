@component('mail::message')
# Hello! {{$details['user']}}
<br>
{{$details['message']}}

@component('mail::button', ["url"=>"#", 'color' => 'green'])
{{$details["token"]}}
@endcomponent

Thank you,<br>
{{ config('app.name') }}
@endcomponent
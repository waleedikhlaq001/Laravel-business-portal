@component('mail::message')
# Hello! {{$details['user']}}
<br>
{{$details['message']}}
<br>


@component('mail::button', ['url' => $details['url'], 'color' => 'green'])
View Job
@endcomponent

Thank you,<br>
{{ config('app.name') }} Team
@endcomponent

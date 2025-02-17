@component('mail::message')
# Hello! {{$details['user']}}
<br>
{{$details['message']}}
<br>


@component('mail::button', ['url' => '#'])
View Job
@endcomponent

Thank you,<br>
{{ config('app.name') }} Team
@endcomponent

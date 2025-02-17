@component('mail::message')
# Hello! {{$details['user']}}
<br>
{{$details['message']}}
<br>
Password: {{$details['password']}}
<br>
We recommend you change the default password above once you login to your account.

{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}
<br>
Thank you,<br>
{{ config('app.name') }} Team
@endcomponent
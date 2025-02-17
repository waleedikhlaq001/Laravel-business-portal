@component('mail::message')
<br>
{{$details['message']}}
<br>
<br>
@component('mail::button', ['url' => $details['url'], 'color' => 'green'])
View Bids
@endcomponent
<br>
<br>
<br>
Thank you,<br>
{{ config('app.name') }} Team
@endcomponent
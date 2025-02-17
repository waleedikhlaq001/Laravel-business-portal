@component('mail::message')
# Hi! {{$details['user']}}
<br>
This is just to notify you that the following payment method has
been successfully added to your account
{{-- {{$details['message']}} --}}
<br>
Please contact <em>support@vicomma.com</em> if you did not authorize this addition.
<br>
<br>

Thank you,<br>
{{ config('app.name') }} Team
@endcomponent
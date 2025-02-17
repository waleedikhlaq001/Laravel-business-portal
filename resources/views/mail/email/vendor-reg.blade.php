<style>
    .mImg {
        height: 50px !important;
        width: 50px !important;
        padding: 10px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        background: #6f3c96 !important;
        border-radius: 50% !important
    }

    .mImg img {
        width: 30px;
        height: 25px;
    }

</style>
@component('mail::message')
# Hi, {{$details['user']}}
<br>
{{$details['message']}}

@component('mail::table')
| | | |
| ------------- |:-------------:| --------:|
| <div class="mImg"><img src="{{asset('/images/EMAIL.png')}}" alt=""></div>| <a href="{{$details['url']}}"
    style="color: #000;text-decoration: none;">
    <p>Verify your email</p>
</a> |
| <div class="mImg"><img src="{{asset('/images/PROFILE.png')}}" alt=""></div> | <p>Update your profile details</p> |
| <div class="mImg"><img src="{{asset('/images/MAKE-A-BID.png')}}" alt=""></div> | <p>Post your first Job</p> |
| <div class="mImg"><img src="{{asset('/img/sidebarlogo.png')}}" alt=""></div> | <p>Update your Location Details</p> |
@endcomponent
<br>
<br>
Thank you,<br>
{{ config('app.name') }} Team
@endcomponent
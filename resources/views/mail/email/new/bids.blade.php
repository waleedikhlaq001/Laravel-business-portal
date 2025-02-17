<style>
    .mImg {
        height: 50px !important;
        width: 50px !important;
        padding: 10px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        border: 2px solid #6f3c96 !important;
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
{{$details['message']}}: <a href="{{$details['url']}}">{{$details['job']}}</a>
forward

@component('mail::table')
| | | |
| ------------- |:-------------:| --------:|
@foreach($details["bids"] as $bid)
| <div class="mImg" style="background: url('{{$bid->influencer->image}}') center; background-size: cover;"></div> | <p style="margin-top: 0px; margin-left: 5px;">{{Str::limit($bid->proposal, 70)}}</p> |
@endforeach
@endcomponent
<br>
@component('mail::button', ['url' => $details['url'], 'color' => 'green'])
View All Bids
@endcomponent
<br>
<br>
Thank you,<br>
{{ config('app.name') }} Team
@endcomponent 
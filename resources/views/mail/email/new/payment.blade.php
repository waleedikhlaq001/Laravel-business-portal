<style>
    .mImg {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
    }
    .jbAwdCnt {
        display: flex;
        /* align-items: center; */
        padding: 10px!important;
        margin: 10px!important;
    }

    .jbAwdCntImg {
        margin-right: 10px!important;
    }

    .jbAwdCntImg img {
        width: 100px;
        height: 50px;
    }

    @media only screen and (max-width: 600px) {
        .jbAwdCnt {
            display: block!important;
        }
        .jbAwdCntImg img {
            width: 60px!important;
            height: 50px!important;
        }
    }

</style>
@component('mail::message')
# Hi, {{$details['user']}}
<br>
The 1st Milestone payment for <a href="{{$details['urlChat']}}">{{$details['job']}}</a> was successfully paid!.

<div class="jbAwdCnt">
    <div class="jbAwdCntImg"><img src="{{asset('/images/chat.png')}}" alt=""></div>
    <div>
        @if($details["milestone"] == 'Video Uploaded')
        <p style="margin-bottom: 0;"> <strong style="color: #000;">If you want to discuss and get updates from {{$details['creative']}} just click the chat button below.</strong> </p>
        @component('mail::button', ['url' => $details['urlChat'], 'color' => 'green'])
        Chat
        @endcomponent
        @else 
        <p style="margin-bottom: 0;"> <strong style="color: #000;">{{$details['creative']}} Has Completed the final milestone for your job: <a href="{{$details['urlChat']}}">{{$details['job']}}</a></strong> </p>
        @endif
    </div>
</div>


<br>
{{-- $details['message'] --}}
<br>
<br>
Thank you,<br>
{{ config('app.name') }} Team
@endcomponent
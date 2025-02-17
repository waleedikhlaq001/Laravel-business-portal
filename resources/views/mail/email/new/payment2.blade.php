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
You have recieved a Milestone Payment for the job <a href="{{$details['urlChat']}}">{{$details['job']}}</a> was successful.

<div class="jbAwdCnt">
    <div class="jbAwdCntImg"><img src="{{asset('/images/chat.png')}}" alt=""></div>
    <div>
        @if($details["milestone"] == 'Video Uploaded')
        <p style="margin-bottom: 0;"> <strong style="color: #000;">You can Reach out to {{$details['vendor']}}</strong> </p>
        <p style="margin-bottom: 0;">Discuss and get updated on your progress with the Job. </p>
        @component('mail::button', ['url' => $details['urlChat'], 'color' => 'green'])
        Chat
        @endcomponent
        @else 
        <p style="margin-bottom: 0;"> <strong style="color: #000;">{{$details['vendor']}} Has Made the final milestone Payment for The job: <a href="{{$details['urlChat']}}">{{$details['job']}}</a></strong> </p>
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
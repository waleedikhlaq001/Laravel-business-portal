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
Congratulations on landing the job <a href="{{$details['urlChat']}}">{{$details['job']}}</a> from {{$details['vendor']}}

<div class="jbAwdCnt">
    <div class="jbAwdCntImg"><img src="{{asset('/images/chat.png')}}" alt=""></div>
    <div>
        <p style="margin-bottom: 0;"> <strong style="color: #000;">Reach out to {{$details['vendor']}}</strong> </p>
        <p style="margin-bottom: 0;">Try and get as much data and information needed for the project from your Vendro.
            To do this simply, chat freely with <strong style="color: #000;">{{$details['vendor']}}</strong> </p>
        @component('mail::button', ['url' => $details['urlChat'], 'color' => 'green'])
        Chat
        @endcomponent
    </div>
</div>


<br>
{{$details['message']}}
<br>
<br>
Thank you,<br>
{{ config('app.name') }} Team
@endcomponent
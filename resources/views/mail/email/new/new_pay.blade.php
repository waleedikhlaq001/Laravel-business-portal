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
Your VWallet Deposit of <b>{{$details['currency']}} {{$details['amount']}}</b> for the job <a href="{{$details['url']}}">{{$details['job']}}</a> was successful.

<div class="jbAwdCnt">
    <div>
        @component('mail::button', ['url' => $details['url'], 'color' => 'green'])
        View Job
        @endcomponent
    </div>
</div>


<br>
{{-- $details['message'] --}}
<br>
<br>
Thank you,<br>
{{ config('app.name') }} Team
@endcomponent
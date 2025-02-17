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
Congratulations on successfully awarding your job <a href="{{$details['urlChat']}}">{{$details['job']}}</a> to your new Creative, {{$details['creative']}}

<div class="jbAwdCnt">
    <div class="jbAwdCntImg"><img src="{{asset('/images/chat.png')}}" alt=""></div>
    <div>
        <p style="margin-bottom: 0;"> <strong style="color: #000;">Now you can reach out to {{$details['creative']}} to get your content. Here are a few steps that will help you along the way.</strong> </p>
        <p style="margin-bottom: 0;">Try and provide as much information about what you want to see in your content to your Creative. reach out to your Creative now by clicking on the chat button below to start a conversation <strong style="color: #000;">{{$details['creative']}}</strong> </p>
        @component('mail::button', ['url' => $details['urlChat'], 'color' => 'green'])
        Chat
        @endcomponent
    </div>
</div>
<div class="jbAwdCnt">
    <div class="jbAwdCntImg"><img src="{{asset('/images/milestone.png')}}" alt=""></div>
    <div>
        <p style="margin-bottom: 0;"> <strong style="color: #000;">Make timely Milestone Payments</strong> </p>
        <p>The quicker you make your first Milestone payment for the Creative to begin your Project, the better for the overall
        time to complete your Project. So why not get started now?</p>
        @component('mail::button', ['url' => $details['urlPayment'], 'color' => 'green'])
        Make initial payment
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
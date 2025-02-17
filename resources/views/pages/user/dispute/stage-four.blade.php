@extends('pages.app')

<style>

    div{
        font-family: "Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
    }

    .dispute-title, .modal-title, .message-sender{
        font-size: 1.5rem;
        line-height: 1em;
        margin: 0;
        font-family: inherit;
        font-weight: 500;
        line-height: 1.2;
        color: #66972b;
    }

    .dispute-title>span{
        color:black;
    }

    .dispute-desc{
        font-size: 16px;
        color: #000;
        line-height: 28px;
        font-family: inherit;
    }

    .btn{
        margin-top: 20px;
    }

    div.input{
        display: flex;
        flex-direction: column;
    }

    div.input>textarea{
        border-color: rgb(185, 185, 185);
    }
    div.input>textarea:focus{
        border-color: rgb(54, 165, 238);
    }

    div.input>input{
        padding: 10px;
        border: 1px solid #6f3c96;
    }

    .dispute-card{
        display: block;
        -webkit-text-decoration: none;
        text-decoration: none;
        color: #000;
        background-color: #fff;
        box-sizing: border-box;
        border-radius: 4px;
        box-shadow: 0 1px 3px rgb(0 0 0 / 5%), rgb(0 0 0 / 5%) 0px 28px 23px -7px, rgb(0 0 0 / 4%) 0px 12px 12px -7px;
        padding: 0 16px;
        width:100%;
        margin-top: 20px;
        min-height:200px;
    }

    .dispute-card>img{
        width: inherit;
        vertical-align: middle;
        border-style: none;
        overflow-clip-margin: content-box;
        overflow: clip;
    }


    .dispute-stages{
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
    }

    .dispute-stages>p{
        text-align: center;
        margin: 0 !important;
    }

    .stage, .stage2, .stage3, .stage4{
        background: rgba(154, 154, 154, 0.38);
        min-height:200px;
        padding: 0 !important;
    }

    .stage2{
        background: rgba(154, 154, 154, 0.3);
    }

    .stage3{
        background: rgba(154, 154, 154, 0.22);
    }

    .stage4{
        background: rgba(154, 154, 154, 0.1);
    }

    .stage-div{
        display: flex;
       width: 100%;
       justify-content: center;
    }

    .stage-top1, .stage-top2{
        height: 50px;
        background-color: #66972b;
        color: #ffffff !important;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .stage-top2{
        background-color: #6F3C96;
    }

    .stage-top1>p, .stage-top2>p{
        margin: 0 !important;
        color: #ffffff ;
    }

    .stage-img{
        background-color: #ffffff;
        height: 100px;
        width: 100px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;

    }

    .stage-img>img{
        width: 50px;
        height: 50px;
    }

    .bottom1>p{
        color: #6F3C96 !important;
        font-weight: 600;
    }

    .conversation{
        width:100%;
    }

    .conversation>.top{
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        border-radius: 8px 8px 0px 0px;
        background-color: #6f3c96;
        width: 100%;
        margin-top: 20px;
    }

    .conversation>.top>.actions{
        display: flex;
        justify-content: space-between;
        align-content: center;
        min-width:fit-content;
    }

    .btn-transparent{
        background-color: transparent;
        border: 1px solid #fff;
        color:#fff;
        border-radius: 5px;
        margin-left:10px;
        padding:5px;
    }

    .btn-transparent:hover{
        background: #fff;
        color:#6f3c96;
        border-color: #000;
        padding:5px 10px;
    }

    .conversation>.item{
        background-color: #fff;
        box-sizing: border-box;
        border-radius: 4px;
        height: fit-content;
        margin-top: 20px;
        padding:10px;
        box-shadow: 0 1px 3px rgb(0 0 0 / 5%), rgb(0 0 0 / 5%) 0px 28px 23px -7px, rgb(0 0 0 / 4%) 0px 12px 12px -7px;
    }

    .message-sender, .message-text{
        font-size:15px;
        margin: 0 !important;
    }

    .message-time{
        color:#66972b;
        font-size:12px;
        margin:0 !important;
    }

    .top>.dispute-title{
        color: #fff;
    }

    .pay-card{
        -webkit-tap-highlight-color: transparent;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        -webkit-text-decoration: none;
        text-decoration: none;
        color: #000;
        background-color: #fff;
        box-sizing: border-box;
        border-radius: 4px;
        box-shadow: 0 1px 3px rgb(0 0 0 / 5%), rgb(0 0 0 / 5%) 0px 28px 23px -7px, rgb(0 0 0 / 4%) 0px 12px 12px -7px;
        padding: 16px;
        min-height: 100px;
        border-top: 2px solid #6F3C96 !important;
        margin:50px 10px !important;
    }
    .pay-card>p{
        margin-bottom: 0.5rem;
        font-family: inherit;
        font-weight: 500;
        font-size: 1rem;
        line-height: 1.2;
        color: inherit;
    }

    .pay-card>p>span{
        color:#6F3C96;
    }

    .pay-card>.box{
        display: flex;
        justify-content: center;
        text-align: center;
        padding: 10px;
        padding-top: 12px;
        margin: 30px 0;
        border: 1px solid #dfdfdf;
        width: 80%;
        min-height: 50px;
    }

    .btn-flex{
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .btn-flex>.btn{
        margin:0 10px;
    }

</style>
@section('content')
<div>
    <div>
        <p class="dispute-title">
            Stage 4: <span>Conclusion</span>
        </p>

        <p class="dispute-desc">
           The dispute has been mitigated, see decision below.
        </p>

        <p class="dispute-title">
            Project Name: <span>{{$dispute->title}}</span>
        </p>
    </div>
    <div class="dispute-card">

        <div class="dispute-stages">

            <div class="col-6 col-md-3 stage">
                <div class="stage-top1">
                    <p>
                        STAGE 1
                    </p>
                </div>

                <div class="stage-div mt-5">
                    <div class="stage-img d-flex">
                        <img src="/images/stage3.png" alt="">
                    </div>
                </div>


                <div class="bottom1 text-center mt-3">
                    <p>
                        "What is the issue?"
                    </p>
                </div>

            </div>

            <div class="col-6 col-md-3 stage2">
                <div class="stage-top2">
                    <p>
                        STAGE 2
                    </p>
                </div>

                <div class="stage-div mt-5">
                    <div class="stage-img d-flex">
                        <img src="/images/stage2.png" alt="">
                    </div>
                </div>


                <div class="bottom1 text-center mt-3">
                    <p>
                        "Discuss & Compromise"
                    </p>
                </div>

            </div>

            <div class="col-6 col-md-3 stage3">
                <div class="stage-top1">
                    <p>
                        STAGE 3
                    </p>
                </div>

                <div class="stage-div mt-5">
                    <div class="stage-img d-flex">
                        <img src="/images/stage1.png" alt="">
                    </div>
                </div>


                <div class="bottom1 text-center mt-3">
                    <p>
                        "Pay & Resolve"
                    </p>
                </div>

            </div>

            <div class="col-6 col-md-3 stage4">
                <div class="stage-top2">
                    <p>
                        STAGE 4
                    </p>
                </div>

                <div class="stage-div mt-5">
                    <div class="stage-img d-flex">
                        <img src="/images/stage1.png" alt="">
                    </div>
                </div>


                <div class="bottom1 text-center mt-3">
                    <p>
                        "Conclusion"
                    </p>
                </div>

            </div>

        </div>

    </div>

    <div class="conversation">
        <div class="top">
            <p class="dispute-title">
                Mitigation Decision
            </p>
            @if ($mitigation->payee_id != auth()->user()->id  && !auth()->user()->hasRole('admin'))
                <a class="btn btn-secondary" style="border: 1px solid white;" href="javascript:void()">Pay mitigated amount</a>
            @endif

        </div>


    </div>

    <div class="row">
        <div class="col-md-5 pay-card">
            <p class="text-center">
                Mitigation Title: <span>{{$mitigation->title}}</span><br>
                Mitigation Status: <span>{{$mitigation->status}}</span>

            </p>

            <div class="box">
                <p class="text-center">
                    Decision <br/><br/> <b style="color: #6F3C96; font-size:1rem">{{$mitigation->decision}}</b>
                </p>
            </div>


            <div class="box">
                <p class="text-center">
                    Reason <br/><br/> <b style="color: #6F3C96; font-size:1rem">{{$mitigation->reason}}</b>
                </p>
            </div>


        </div>
    </div>

 </div>
@endsection

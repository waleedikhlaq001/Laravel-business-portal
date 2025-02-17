@extends('pages.app')

<style>

    div{
        font-family: "Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
    }

    .dispute-title, .modal-title{
        font-size: 1.5rem;
        line-height: 1em;
        margin: 0;
        font-family: inherit;
        font-weight: 500;
        line-height: 1.2;
        color: #6f3c96;
    }

    .title>span{
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

</style>
@section('content')
<div>
    <div>
        <p class="dispute-title">
            Stage 1: <span>Initiate Dispute</span>
        </p>

        <p class="dispute-desc">
            Do you have an issue related to the job delivery and payments? file a complaint now.
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
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
        Start Dispute Process
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Stage 1: What is the Issue?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('user.dispute.register')}}" method="post">
                @csrf
                <input type="hidden" name="job_id" value="{{$job_id}}">
                <div class="input modal-body">
                    <label for="">So, what is wrong?</label>
                    <textarea id="" cols="15" rows="3" name="message" value="" placeholder="Please describe in details what is wrong"></textarea>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-outline-primary">Agree and Pay</a>
                    <input type="submit" class="btn btn-secondary" value="Continue Dispute"/>
                </div>
            </form>

            </div>
        </div>
    </div>
 </div>
@endsection

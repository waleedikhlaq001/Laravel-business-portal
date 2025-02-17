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
        color: #6f3c96;
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


    .mitigation_content{
        padding:1rem;
    }

    .mitigation_content>p{
        margin:0;
        font-weight: 700;
    }

    .mitigation_content>ul, .mitigation_content>li{
        font-weight: 400;
    }

</style>
@section('content')
<div>
    <div>
        <p class="dispute-title">
            Stage 2: <span>Discuss & Compromise</span>
        </p>

        <p class="dispute-desc">
            Do you have an issue related to the job delivery and payments? file a complaint now.
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
                Discussion
            </p>

            <div class="actions">
                @if ($job->vendor->user_id = Auth::user()->id)
                    <a class="btn btn-primary mr-2" href="{{route('user.dispute.drop', $dispute->id)}}">Drop Dispute</a>
                    <a class="btn btn-primary text-white" data-toggle="modal" data-target="#agreedAmountModal">Pay for mitigation</a>
                @endif

            </div>
        </div>
        <div id="chats" class="py-2">
        @forelse ($messages as $item)
            <div class="item">
                <p class="message-sender"><span>{{$item->user->first_name.' '.$item->user->last_name.': '.$item->sender == "Influencer"? "Creative" : $item->sender}}</span> </p>

                <p class="message-text">{{$item->message}}</p>
                <p class="message-time">{{$item->created_at}}</p>

            </div>
        @empty

        @endforelse
        </div>
        <div>{{-- $messages->appends($_GET)->links() --}}</div>



    </div>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
        Send Message
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Send a message to thread</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('user.dispute.message.store')}}" method="post">
                @csrf
                <input type="hidden" name="job_id" value="{{$job_id}}">
                <div class="input modal-body">
                    <label for="">Enter Message</label>
                    <textarea id="" cols="15" rows="3" name="message" value="" placeholder="Enter Message"></textarea>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-secondary" value="Send"/>
                </div>
            </form>

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="agreedAmountModal" tabindex="-1" role="dialog" aria-labelledby="agreedAmountModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Terms of our mitigation process.</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>


            <div class="mitigation_content">

                <p>
                    You have chosen to mitigate this transaction. We would love an amicable resolution to this matter so we would request that you and your
                    Creative reach a friendly compromise. If you still choose to mitigate, here are the steps;
                </p>

                <p>
                    Vendor

                    <ul>
                        <li>
                            You pay a total amount of 25% of the disputed fee.
                        </li>

                        <li>
                            This payment is made before the vicomma dispute mitigation process is began
                        </li>
                    </ul>
                </p>


                <p>
                    Creative

                    <ul>
                        <li>
                            You pay a total amount of 15% of the disputed fee.
                        </li>

                        <li>
                            This payment is made before the vicomma dispute mitigation process is began
                        </li>
                    </ul>
                </p>
            </div>


            <a class="btn btn-secondary text-white" style="width:30%; margin:auto;margin-bottom:20px;" href="{{route('user.dispute.mitigate', $dispute->id)}}">Continue</a>


            </div>
        </div>
    </div>
 </div>
@endsection
@push('scripts')
<script>
     jQuery('document').ready(function() {
window.Echo.private('new-dispute-msg')
    .listen('NewDisputeMsg', (e) => {
        console.log(e);
        if("{{$dispute->id}}" == e.dispute.id){
            console.log(e)
            var txt = ``;

            e.dispute.dispute_message.map(d => {
                txt += `
                <div class="item">
                <p class="message-sender"><span>${d.user.first_name + ' ' + d.user.last_name + ': ' + d.sender == "Influencer"? "Creative" : d.sender}</span> </p>

                <p class="message-text">${d.message}</p>
                <p class="message-time">${d.created_at}</p>

            </div>
                `;
            })

            $("#chats").html(txt);
        }
    });

});
</script>
@endpush
@extends('pages.app')
<link rel="stylesheet" href="{{asset('/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('/css/select2-bootstrap.min.css')}}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.25.1/moment.min.js"></script>

<style>

    .title{
        font-size: 2rem;
        line-height: 1em;
        margin: 0;
        font-family: inherit;
        font-weight: 500;
        line-height: 1.2;
        color: #6f3c96;
    }

    .form-group {
        transition: .5s;
    }

    .error {
        color: red;
        display: block;
        margin-top: .5rem;
    }

    .heading {
        color: #6f3c96;
        margin: 0 !important;
    }

    .msg-card{
        height: fit-content;
        width: 100%;
    }

    .align-center{
        align-items: center;
    }

    p{
        line-height: 22px !important;
    }

    .fa-user{
        color: rgb(167, 165, 165);
    }

    .message-text{
        font-size:15px;
        color: #17191C;
        margin-top:10px;
    }

    .message-time{
        color:#66972b;
        font-size:12px;
        margin:0 !important;
    }


</style>
@section('content')
@include('includes.messages')

<div class="row mh-100">

    <p class="title mb-4">
        Ticket {{$ticket->ticket_id}} - {{$ticket->subject}}
    </p>
    <div class="p-2">

        <div class="row">
            <div class="card shadow col-md-3 ticket-info p-3">

                <h5 class="mb-3">Ticket Information</h5>

                <div>
                    <p class="heading">Requestor</p>
                    <p>{{$ticket->user->first_name.' '.$ticket->user->last_name}}</p>
                </div>

                <div>
                    <p class="heading">Submitted</p>
                    <p id="dos"> {{$ticket->created_at}} </p>
                </div>

                <div>
                    <p class="heading">Last updated</p>
                    <p id="dou">{{$ticket->updated_at}} </p>
                </div>

                <div>
                    <p class="heading">Status/Priority</p>
                    <h6>
                        <span class="badge badge-success">{{$ticket->status}}</span> /
                        <span class="badge badge-warning">{{$ticket->priority}}</span>
                    </h6>
                </div>

                <div class="row">
                    <button type="button" class="btn btn-block btn-secondary col-12"  data-toggle="modal" data-target="#replyTicket">Reply @if($ticket->status == 'closed') To Reopen @endif</button>
                    <a style="padding: 0 !important;" @if($ticket->status == 'closed') href="javascript:void()" @else href="{{route('user.support.ticket.close', ['id'=>$ticket->ticket_id])}}" @endif class="col-12"><button type="button" @if($ticket->status == 'closed') disabled @endif class="btn btn-block btn-primary col-12 mt-2">Close </button></a>
                </div>

            </div>

            <div id="messages" class="col-md-9 px-4 mh-100">
                <div id="title" class="border py-2 px-1 mb-2" style="background-color: #6f3c96;color:#fff;">
                    Support Ticket Messages
                </div>

                @forelse ($messages as $message)
                    <div class="card shadow p-3 msg-card mt-5">
                        <div class="d-flex">
                            <i class="fa fa-user mr-3 align-center"></i>
                            <p class="" style="font-size:18px;margin:0 !important;">{{$message->sender}}</p>
                            <span class="badge @if($message->user_id == $ticket->user_id) badge-success @else badge-warning @endif ml-3">@if($message->user_id == $ticket->user_id) Owner @else Vicomma Admin @endif</span>
                        </div>
                        <hr>

                        <p class="message-text">{{$message->message}}</p>
                        <p class="message-time">{{$message->created_at}}</p>
                    </div>
                @empty

                @endforelse

                <div>{{$messages->appends($_GET)->links()}}</div>


            </div>
        </div>

    </div>
</div>


<!-- Modal -->
<div class="modal fade verifyCountryModal" id="replyTicket" tabindex="-1" aria-labelledby="replyTicketLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="replyTicketLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6 class="text-center">Reply to Ticket Created</h6>
                <form action="{{route('user.support.ticket.reply', $ticket->id)}}" method="post">
                    @csrf
                    <textarea name="message" class="form-control mb-2" type="text" placeholder="Enter message here..." required></textarea>
                    <button class="btn btn-secondary btn-block mt-3 cls">Reply</button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection

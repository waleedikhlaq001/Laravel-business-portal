@extends('admin.app')
@section('content')
<link href="/css/ticket.css" rel="stylesheet">
<div class="container-fluid dtt">
    <div class="row">
    <div class="nk-content-body">
    <div class="nk-content-wrap">
        <div class="nk-block-head">
            <div class="nk-block-between g-3">
                <div class="nk-block-head-content">
                    <h3 class="nk-block-title page-title">Support Ticket <strong class="text-primary small">{{$ticket->ticket_id}}</strong></h3>
                </div>
                <div class="nk-block-head-content"><a class="back-to" href="/admin/support"><em class="icon bi bi-arrow-left"></em><span>Back</span></a></div>
            </div>
        </div>
        <div class="nk-block">
            <div class="ticket-info">
                <ul class="ticket-meta">
                    <li class="ticket-id"><span>Ticket ID:</span> <strong>{{$ticket->ticket_id}}</strong></li>
                    <li class="ticket-date"><span>Submitted:</span> <strong>{{\Carbon\Carbon::parse($ticket->created_at)->format('d, M Y')}}</strong></li>
                    <li class="ticket-date"><span>Last Reply:</span> <strong>{{\Carbon\Carbon::parse($messages[0]->created_at)->format('d, M Y')}}</strong></li>
                </ul>
                <div class="ticket-status">
                @if($ticket->status == "open")
                                 <span class="badge badge-success">OPEN</span></td>
                                @endif
                                @if($ticket->status == "closed")
                                <span class="badge badge-danger">CLOSED</span></td>
                                @endif
                </div>
            </div>
        </div>
        <div class="nk-block nk-block-lg">
            <div class="card card-bordered">
                <div class="card-inner">
                    <div class="ticket-msgs">
                        @foreach($messages as $message)
                        @if($message->user_id !== Auth::user()->id)
                        <div class="ticket-msg-item">
                            <div class="ticket-msg-from">
                                <div class="ticket-msg-user user-card">
                                <div class="user-avatar"><img src="{{$user->image}}" alt=""></div>
                                    <div class="user-info"><span class="lead-text">{{$user->first_name}} {{$user->last_name}}</span><span class="text-soft">{{$user->role}}</span></div>
                                </div>
                                <div class="ticket-msg-date"><span class="sub-text">{{\Carbon\Carbon::parse($message->created_at)->format('M, d Y h:i:s a')}}</span></div>
                            </div>
                            <div class="ticket-msg-comment">
                               {!! $message->message !!}
                            </div>
                        </div>
                        @else
                        <div class="ticket-msg-item is-mine">
                            <div class="ticket-msg-from">
                                <div class="ticket-msg-user user-card">
                                <div class="user-avatar"><img src="{{Auth::user()->image}}" alt=""></div>
                                    <div class="user-info"><span class="lead-text">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</span><span class="text-soft">ME</span></div>
                                </div>
                                <div class="ticket-msg-date"><span class="sub-text">{{\Carbon\Carbon::parse($message->created_at)->format('M, d Y h:i:s a')}}</span></div>
                            </div>
                            <div class="ticket-msg-comment">
                            {!! $message->message !!}
                            </div>
                            <!-- <div class="ticket-msg-attach">
                                <h6 class="title">Attachment</h6>
                                <ul class="ticket-msg-attach-list">
                                    <li><a href="#"><img src="/demo4/images/gfx/attach-a.jpg" alt=""><em class="icon ni ni-download"></em></a></li>
                                    <li><a href="#"><img src="/demo4/images/gfx/attach-b.jpg" alt=""><em class="icon ni ni-download"></em></a></li>
                                </ul>
                            </div> -->
                        </div>
                        @endif
                        @endforeach
                        <div class="ticket-msg-reply">
                            <h5 class="title">Reply</h5>
                            <form action="#" class="form-reply">
                                <div class="form-group">
                                    <div class="form-editor-custom"><textarea class="form-control" placeholder="Write a message..."></textarea>
                                       
                                    </div>
                                </div>
                                <div class="form-action">
                                    <ul class="form-btn-group">
                                        <li class="form-btn-primary"><a href="#" class="btn btn-primary">Send</a></li>
                                        @if($ticket->status == "open")
                                        <li class="form-btn-secondary"><a href="#" class="btn btn-dim btn-outline-light">Mark as close</a></li>
                                @endif
                                    </ul>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

   
</div>
    <!-- /.row -->
</div><!-- /.container-fluid -->
@endsection
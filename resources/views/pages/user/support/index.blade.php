@extends('pages.app')

<style>
    .ticket-title{
        font-size: 2rem;
        line-height: 1em;
        margin: 0;
        font-family: inherit;
        font-weight: 500;
        line-height: 1.2;
        color: #6f3c96;
    }

    .btn-primary{
        padding: 10 !important;
    }

    .search-form{
        position: relative;
        margin: 0;
    }

    .search-form>input{
        height: 50px;
        padding:15px 30px;
    }

    .fa-search{
        position: absolute;
        font-size: 7px;
        color: #6f3c96;
        top:15px;
        left:5px;
    }

    .ticket-card{
        display: block;
        -webkit-text-decoration: none;
        text-decoration: none;
        color: #000;
        background-color: #fff;
        box-sizing: border-box;
        border-radius: 4px;
        box-shadow: 0 1px 3px rgb(0 0 0 / 5%), rgb(0 0 0 / 5%) 0px 28px 23px -7px, rgb(0 0 0 / 4%) 0px 12px 12px -7px;
        padding: 16px;
        width:100%;
        min-height:200px;
        margin-top: 50px;
    }

    thead{
        border-radius: 20px !important;
        background-color: #8f8f8f !important;

    }

    th{
        color: #ffffff;
    }

    td.ticket_id{
        color:rgb(81, 26, 219);
        font-size:20px;
    }

    td.ticket_subject{
        color:rgb(27, 44, 44);
        font-size: 15px;
    }

    td.ticket_status_open{
        color:#66972b;
    }

    td.ticket_status_close{
        color:#cf3535;
    }

    tbody>tr{
        padding: 20px 0 !important;
        cursor:pointer !important;
        height: 60px !important;
    }

    tbody>tr:hover{
        background-color: #e7dfed !important;
        box-shadow: 0 1px 3px rgb(0 0 0 / 5%), rgb(0 0 0 / 5%) 0px 28px 23px -7px, rgb(0 0 0 / 4%) 0px 12px 12px -7px !important;

    }
</style>

@section('content')

<div class="d-flex justify-content-between">
    <p class="ticket-title">My Support Tickets</p>

    <div class="d-flex">
        <a class="btn btn-primary mr-3" href="{{route('user.support.ticket.create')}}" target="_blank">+ Create Ticket</a>

        <form action="" method="post" class="search-form">
            <i class="fa fa-search"></i>
            <input type="text" name="ticket_id" id="" placeholder="search a ticket">
        </form>
    </div>
</div>

<div class="ticket-card">
    <table class="table">

        <thead>
            <th>Ticket ID</th>
            <th>Subject</th>
            <th>Status</th>
            <th>Last Updated</th>
        </thead>

        <tbody>

            @forelse ($tickets as $ticket)

                <tr>
                    <td class="ticket_id"><a href="{{route('user.support.ticket.show', ['id' => $ticket->ticket_id])}}">{{$ticket->ticket_id}} </a></td>
                    <td class="ticket_subject"><a href="{{route('user.support.ticket.show', ['id' => $ticket->ticket_id])}}" style="color: inherit !important"> {{$ticket->subject}} </a></td>
                    <td  @if($ticket->status == 'open') class="ticket_status_open" @else class="ticket_status_close" @endif><a style="color: inherit !important" href="{{route('user.support.ticket.show', ['id' => $ticket->ticket_id])}}">{{$ticket->status}} </a></td>
                    <td><a style="color: inherit !important" href="{{route('user.support.ticket.show', ['id' => $ticket->ticket_id])}}">{{$ticket->updated_at}}</a></td>
                </tr>

            @empty
                <tr>
                    <div class="text-center ticket-title">You don't have any ticket</div>
                </tr>



            @endforelse


            {{-- <tr>
                <td class="ticket_id">#VSP-234-67345</td>
                <td class="ticket_subject">SSL cert not working</td>
                <td class="ticket_status_close">Closed</td>
                <td>#VSP-234-67345</td>
            </tr>

            <tr>
                <td class="ticket_id">#VSP-234-67345</td>
                <td class="ticket_subject">SSL cert not working</td>
                <td class="ticket_status_open">Open</td>
                <td>#VSP-234-67345</td>
            </tr> --}}
        </tbody>

    </table>
</div>

@endsection

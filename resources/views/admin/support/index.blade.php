@extends('admin.app')
@push("css")
<style>
.card-bordered {
    border: 1px solid #dbdfea!important;
}

.tb-ticket-item .title {
    font-weight: 500;
    color: #364a63;
}

.tb-ticket-id a, .tb-ticket-desc a {
    display: block;
    padding: 0.25rem 0;
    color: #94ca52;
}
td,th {
    margin: 0;
}

.card {
    --bs-card-spacer-y: 0.75rem;
    --bs-card-spacer-x: 1.25rem;
    --bs-card-title-spacer-y: 0.75rem;
    --bs-card-border-width: 0;
    --bs-card-border-color: rgba(0, 0, 0, 0.125);
    --bs-card-border-radius: 4px;
    --bs-card-box-shadow: ;
    --bs-card-inner-border-radius: 3px;
    --bs-card-cap-padding-y: 0.75rem;
    --bs-card-cap-padding-x: 1.25rem;
    --bs-card-cap-bg: rgba(0, 0, 0, 0.07);
    --bs-card-cap-color: ;
    --bs-card-height: ;
    --bs-card-color: ;
    --bs-card-bg: #fff;
    --bs-card-img-overlay-padding: 1.25rem;
    --bs-card-group-margin: 14px;
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    height: var(--bs-card-height);
    word-wrap: break-word;
    background-color: var(--bs-card-bg);
    background-clip: border-box;
    border: var(--bs-card-border-width) solid var(--bs-card-border-color);
    border-radius: var(--bs-card-border-radius);
}

.card .table {
    margin-bottom: 0;
}

.table-tickets {
    font-size: 13px;
    color: #8094ae;
}
.table {
    --bs-table-color: #526484;
    --bs-table-bg: transparent;
    --bs-table-border-color: #dbdfea;
    --bs-table-accent-bg: #fff;
    --bs-table-striped-color: #526484;
    --bs-table-striped-bg: rgba(0, 0, 0, 0.05);
    --bs-table-active-color: var(--bs-body-color);
    --bs-table-active-bg: #f5f6fa;
    --bs-table-hover-color: var(--bs-body-color);
    --bs-table-hover-bg: #f5f6fa;
    width: 100%;
    margin-bottom: 1rem;
    color: var(--bs-table-color);
    vertical-align: top;
    border-color: var(--bs-table-border-color);
}
table {
    caption-side: bottom;
    border-collapse: collapse;
}
*, *::before, *::after {
    box-sizing: border-box;
}
table {
    display: table;
    border-collapse: separate;
    box-sizing: border-box;
    text-indent: initial;
    border-spacing: 0;
    border-color: gray;
}
.card {
    --bs-card-spacer-y: 0.75rem;
    --bs-card-spacer-x: 1.25rem;
    --bs-card-title-spacer-y: 0.75rem;
    --bs-card-border-width: 0;
    --bs-card-border-color: rgba(0, 0, 0, 0.125);
    --bs-card-border-radius: 4px;
    --bs-card-box-shadow: ;
    --bs-card-inner-border-radius: 3px;
    --bs-card-cap-padding-y: 0.75rem;
    --bs-card-cap-padding-x: 1.25rem;
    --bs-card-cap-bg: rgba(0, 0, 0, 0.07);
    --bs-card-cap-color: ;
    --bs-card-height: ;
    --bs-card-color: ;
    --bs-card-bg: #fff;
    --bs-card-img-overlay-padding: 1.25rem;
    --bs-card-group-margin: 14px;
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    height: var(--bs-card-height);
    word-wrap: break-word;
    background-color: var(--bs-card-bg);
    background-clip: border-box;
    border: var(--bs-card-border-width) solid var(--bs-card-border-color);
    border-radius: var(--bs-card-border-radius);
}
.container, .container-fluid, .container-xxl, .container-xl, .container-lg, .container-md, .container-sm {
    --bs-gutter-x: 14px;
    --bs-gutter-y: 0;
    width: 100%;
    padding-right: calc(var(--bs-gutter-x)*.5);
    padding-left: calc(var(--bs-gutter-x)*.5);
    margin-right: auto;
    margin-left: auto;
}
.bg-white {
    --bs-bg-opacity: 1;
    background-color: rgba(var(--bs-white-rgb), var(--bs-bg-opacity)) !important;
}

.table>thead {
    vertical-align: bottom;
}
thead, tbody, tfoot, tr, td, th {
    border-color: inherit;
    border-style: solid;
    border-width: 0;
}
body {
    margin: 0;
    font-family: var(--bs-body-font-family);
    font-size: var(--bs-body-font-size);
    font-weight: var(--bs-body-font-weight);
    line-height: var(--bs-body-line-height);
    color: var(--bs-body-color);
    text-align: var(--bs-body-text-align);
    background-color: var(--bs-body-bg);
    -webkit-text-size-adjust: 100%;
    -webkit-tap-highlight-color: rgba(0,0,0,0);
}
:root {
    --fc-list-event-dot-width: 10px;
    --fc-list-event-hover-bg-color: #f5f5f5;
}
:root {
    --fc-daygrid-event-dot-width: 8px;
}
:root {
    --bs-blue: #559bfb;
    --bs-indigo: #2c3782;
    --bs-purple: #816bff;
    --bs-pink: #ff63a5;
    --bs-red: #e85347;
    --bs-orange: #ffa353;
    --bs-yellow: #f4bd0e;
    --bs-green: #1ee0ac;
    --bs-teal: #20c997;
    --bs-cyan: #09c2de;
    --bs-white: #fff;
    --bs-gray: #8091a7;
    --bs-gray-dark: #2b3748;
    --bs-gray-100: #ebeef2;
    --bs-gray-200: #e5e9f2;
    --bs-gray-300: #dbdfea;
    --bs-gray-400: #b7c2d0;
    --bs-gray-500: #8091a7;
    --bs-gray-600: #3c4d62;
    --bs-gray-700: #344357;
    --bs-gray-800: #2b3748;
    --bs-gray-900: #1f2b3a;
    --bs-primary: #6576ff;
    --bs-secondary: #364a63;
    --bs-success: #1ee0ac;
    --bs-info: #09c2de;
    --bs-warning: #f4bd0e;
    --bs-danger: #e85347;
    --bs-light: #e5e9f2;
    --bs-dark: #1f2b3a;
    --bs-gray: #8091a7;
    --bs-lighter: #f5f6fa;
    --bs-primary-rgb: 101, 118, 255;
    --bs-secondary-rgb: 54, 74, 99;
    --bs-success-rgb: 30, 224, 172;
    --bs-info-rgb: 9, 194, 222;
    --bs-warning-rgb: 244, 189, 14;
    --bs-danger-rgb: 232, 83, 71;
    --bs-light-rgb: 229, 233, 242;
    --bs-dark-rgb: 31, 43, 58;
    --bs-gray-rgb: 128, 145, 167;
    --bs-lighter-rgb: 245, 246, 250;
    --bs-white-rgb: 255, 255, 255;
    --bs-black-rgb: 0, 0, 0;
    --bs-body-color-rgb: 82, 100, 132;
    --bs-body-bg-rgb: 245, 246, 250;
    --bs-font-sans-serif: Roboto, sans-serif;
    --bs-font-monospace: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
    --bs-gradient: linear-gradient(180deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0));
    --bs-body-font-family: Roboto, sans-serif;
    --bs-body-font-size: 0.875rem;
    --bs-body-font-weight: 400;
    --bs-body-line-height: 1.65;
    --bs-body-color: #526484;
    --bs-body-bg: #f5f6fa;
    --bs-border-width: 1px;
    --bs-border-style: solid;
    --bs-border-color: #dbdfea;
    --bs-border-color-translucent: rgba(0, 0, 0, 0.175);
    --bs-border-radius: 4px;
    --bs-border-radius-sm: 3px;
    --bs-border-radius-lg: 5px;
    --bs-border-radius-xl: 8px;
    --bs-border-radius-2xl: 2rem;
    --bs-border-radius-pill: 50rem;
    --bs-link-color: #798bff;
    --bs-link-hover-color: #465fff;
    --bs-code-color: #ff63a5;
    --bs-highlight-bg: #fcf8e3;
}


.card .table tr:first-child th:first-child {
    border-top-left-radius: 4px;
}

.card .table tr:first-child th, .card .table tr:first-child td {
    border-top: none;
}
.table thead tr:last-child th {
    border-bottom: 1px solid #dbdfea;
}
.table td:first-child, .table th:first-child {
    padding-left: 1.25rem;
}
.tb-ticket-title th {
    color: #8094ae;
    font-size: 12px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: .1em;
    height: auto;
}
.table>:not(caption)>*>* {
    box-shadow: none;
}
.table th {
    line-height: 1.1;
}
.table>:not(caption)>*>* {
    border-top: 1px solid #dbdfea;
    border-bottom: 0;
}
.table>:not(caption)>*>* {
    padding: 0.5rem 0.5rem;
    background-color: var(--bs-table-bg);
    border-bottom-width: 1px;
    box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
}
.tb-ticket-id {
    font-weight: 500;
    color: #6576ff;
    width: 120px;
}
thead, tbody, tfoot, tr, td, th {
    border-color: inherit;
    border-style: solid;
    border-width: 0;
}
th {
    text-align: inherit;
    text-align: -webkit-match-parent;
}


.card .table tr:first-child th, .card .table tr:first-child td {
    border-top: none;
}
.table thead tr:last-child th {
    border-bottom: 1px solid #dbdfea;
}
.tb-ticket-title th {
    color: #8094ae;
    font-size: 12px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: .1em;
    height: auto;
}
.table>:not(caption)>*>* {
    box-shadow: none;
}
.table th {
    line-height: 1.1;
}
.table>:not(caption)>*>* {
    border-top: 1px solid #dbdfea;
    border-bottom: 0;
}
.table>:not(caption)>*>* {
    padding: 0.5rem 0.5rem;
    background-color: var(--bs-table-bg);
    border-bottom-width: 1px;
    box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
    vertical-align: baseline;
}

.tb-ticket-action {
    text-align: right
}

.tb-ticket-item .tb-ticket-action {
    height: 52px
}

.tb-ticket-title th {
    color: #8094ae;
    font-size: 12px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: .1em;
    height: auto
}

@media(min-width: 1200px) {
    .tb-ticket-item .title {
        max-width: 320px
    }
}

@media(max-width: 575.98px) {
    .table-tickets {
        font-size: 12px
    }
    .tb-ticket-item {
        display: flex;
        position: relative;
        flex-wrap: wrap;
        padding: .5rem 1.25rem;
        align-items: center
    }
    .tb-ticket-item td {
        border: 0;
        padding: 0
    }
    .tb-ticket-item td:first-child,
    .tb-ticket-item td:last-child {
        padding: 0
    }
    .tb-ticket-item td.tb-ticket-id {
        font-size: 14px
    }
    .tb-ticket-item td.tb-ticket-desc {
        font-size: 12px
    }
    .tb-ticket-item:not(:first-child) {
        border-top: 1px solid #dbdfea
    }
    .tb-ticket-item .title {
        max-width: 360px
    }
    .tb-ticket-id {
        width: 100%
    }
    .tb-ticket-item .tb-ticket-id {
        margin-top: .25rem;
        margin-bottom: .125rem
    }
    .tb-ticket-desc {
        width: 78%
    }
    .tb-ticket-id a,
    .tb-ticket-desc a {
        padding: 0
    }
    .tb-ticket-action {
        margin-left: auto
    }
    .tb-ticket-item .tb-ticket-action {
        height: auto
    }
}


</style>
@endpush
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4 col-12">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$all}}</h3>

                    <p>Total Tickets</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="{{route('admin.support.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-12">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$open}}</h3>

                    <p>Open Tickets</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{route('admin.support.index', ['type'=>'open'])}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-12">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{$closed}}</h3>

                    <p>Closed Tickets</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{route('admin.support.index', ['type'=>'closed'])}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <div class="nk-content-body">
    <div class="nk-content-wrap">
        <!-- <div class="nk-block-head">
            <div class="nk-block-between g-3">
                <div class="nk-block-head-content">
                    <h3 class="nk-block-title page-title">Support Ticket</h3>
                    <div class="nk-block-des text-soft">
                        <p>You have total 937 tickets.</p>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="nk-block">
            <div class="card card-bordered">
                <table class="table table-tickets" cellspacing="0">
                    <thead class="tb-ticket-head">
                        <tr class="tb-ticket-title">
                            <th class="tb-ticket-desc tb-col-md"><span>Ticket</span></th>
                            <th class="tb-ticket-desc"><span>Subject</span></th>
                            <th class="tb-ticket-date tb-col-md"><span>Priority</span></th>
                            <th class="tb-ticket-seen tb-col-md"><span>Date Submitted</span></th>
                            <th class="tb-ticket-status"><span>Status</span></th>
                            <th class="tb-ticket-action"> &nbsp; </th>
                        </tr>
                    </thead>
                    <tbody class="tb-ticket-body">
                        @foreach($tickets as $ticket)
                        <tr class="tb-ticket-item is-unread">
                            <td class="tb-ticket-desc tb-col-md"><a href="/admin/support/{{$ticket->ticket_id}}">{{$ticket->ticket_id}}</a></td>
                            <td class="tb-ticket-desc"><a href="/admin/support/{{$ticket->ticket_id}}"><span class="title">{{$ticket->subject}}</span></a></td>
                            <td class="tb-ticket-date tb-col-md">
                                @if($ticket->priority == "low")
                                <span class="text-info">Low</span>
                                @endif
                                @if($ticket->priority == "medium")
                                <span class="text-warning">Medium</span>
                                @endif
                                @if($ticket->priority == "high")
                                <span class="text-danger">High</span>
                                @endif
                            </td>
                            <td class="tb-ticket-seen tb-col-md"><span class="date-last">{{$ticket->created_at}}</span>
                            </td>
                            <td class="tb-ticket-status">
                                @if($ticket->status == "open")
                                 <span class="badge bg-success">OPEN</span></td>
                                @endif
                                @if($ticket->status == "closed")
                                <span class="badge bg-danger">CLOSED</span></td>
                                @endif
                            <td class="tb-ticket-action"><a href="/admin/support/{{$ticket->id}}" class="btn btn-icon btn-trigger"><em class="icon bi bi-chevron-right"></em></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{$tickets->links()}}
    </div>
   
</div>
    <!-- /.row -->
</div><!-- /.container-fluid -->
@endsection
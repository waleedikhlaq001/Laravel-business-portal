@extends('pages.app')
@push('scripts')
<script>
     document.title = "Wallet";
</script>
@endpush
@push('css')
    <style>
        .wallet-balance-card{
            border-radius: 10px;
            background: #cce9a8;
            color: #476423;
            padding: 40px 40px 25px 40px;
        }

        .wallet-balance-card p{
            margin-bottom: 0;
        }

        .transactions p{
            margin-bottom: 0;
        }

        .wallet-balance-card .balance{
            font-size: 40px;
            font-weight: 700;
            color: #476423;
            margin-bottom: 12px;
        }

        .general-wallet .fa{
            font-size: inherit !important;
        }

        .transactions .trans-type{
            font-size: 20px;
            font-weight: 600;
            color: #476423;
        }

        .transactions .job-name{
            font-size: 14px;
        }

        .transactions .trans-time{
            margin-top: -10px;
        }

        .transactions .trans-time small{
            font-size: 10px;
        }

        .trans-table-card{
            border-radius:10px;
            padding: 0 5px;
            background: #f9f9f9;
            border: 1px solid #6f3c9621;
        }

        .badge-green{
            color: #fff;
            background-color: #66972b;
        }

        .badge-purple{
            color: #fff;
            background-color: #885fa7;
        }

        .badge-yellow{
            color: #fff;
            background-color: #b2a720;
        }

        .sec-header{
            color: #476423;
            font-size: 22px;
            font-weight: 400;
        }
    </style>
@endpush
@section('content')
    @include('includes.messages')
    @include('includes.confirm-topup')
    @include('includes.confirm-withdrawal')
    @include('includes.convertvcoin')
    <div class="container-fluid general-wallet">
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="wallet-balance-card shadow-sm">
                    <div class="row">
                        <div class="col-md-8">
                            <p class="balance">${{$gwallet->balance ?? '0'}}</p>
                            <p style="color: #476423; font-size: 14px;">Current Vicomma Wallet Balance</p>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex float-end">
                                <a href="javascript:void(0);" class="btn btn-primary mt-2 text-white" data-bs-target="#topupWallet" data-bs-toggle="modal">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                    Add money to Wallet
                                </a>
                                <a href="javascript:void(0);" class="btn btn-secondary ml-2 mt-2 text-white" data-bs-target="#withdrawWallet" data-bs-toggle="modal" title="Request Withdrawal" style="min-height: unset; min-width: unset;">
                                    <i class="fa fa-sign-out" aria-hidden="true"></i>
                                </a> 
                            </div>
                        </div>
                        
                    </div>
                </div>
    </div>
    <div class="col-md-6">
                <div class="wallet-balance-card shadow-sm">
                    <div class="row">
                        <div class="col-md-8">
                            <p class="balance">{{Auth::user()->vcoin ?? '0'}} vcoins</p>
                            <p style="color: #476423; font-size: 14px;">vcoin Balance</p>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex float-end">
                                <a href="javascript:void(0);" class="btn btn-primary mt-2 text-white" data-bs-target="#topupWallet" data-bs-toggle="modal">
                                    <i class="fa fa-files" aria-hidden="true"></i>
                                    History
                                </a>
                                <a href="javascript:void(0);" class="btn btn-secondary ml-2 mt-2 text-white" data-bs-target="#convertVcoin" data-bs-toggle="modal" title="Request Withdrawal" style="min-height: unset; min-width: unset;">
                                    <i class="fa fa-sign-out" aria-hidden="true"></i>
                                </a> 
                            </div>
                        </div>
                        
                    </div>
                </div>
                </div>
                <div class="col-md-12 mb-3">
                <div class="transactions w-100">
                    <div class="row">
                    <div class="col-md-12 mt-5">
                            <h4 class="mt-3 pl-3 sec-header">Wallet Transactions</h4>
                            <div class="trans-table-card card shadow-sm mt-3">
                                @if(count($gwtransactions)>0)
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Item</th>
                                                <th>Amount</th>
                                                <th>Type</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($gwtransactions as $trans)
                                                <tr>
                                                    <td scope="row">
                                                        <p class="trans-type">{{$trans->name}}</p> 
                                                        <p class="job-name">{{$trans->desc}}</p>
                                                        <p class="trans-time"><small>{{$trans->date}} - {{$trans->time}}</small></p>
                                                    </td>
                                                    <td style="color: #476423;">${{$trans->amount}}</td>
                                                    <td>
                                                        @switch($trans->type)
                                                            @case('credit')
                                                                <span class="badge badge-green">{{ucFirst($trans->type)}}</span>
                                                                @break
                                                            @case('deposit') 
                                                                <span class="badge badge-purple">{{ucFirst($trans->type)}}</span>
                                                                @break
                                                            @case('withdrawal') 
                                                                <span class="badge badge-yellow">{{ucFirst($trans->type)}}</span>
                                                                @break
                                                            @default
                                                                <span class="badge badge-primary">{{ucFirst($trans->type)}}</span>
                                                        @endswitch
                                                    </td>
                                                    <td>
                                                        @switch($trans->status)
                                                            @case('successful')
                                                                <span style="color: #66972b;font-weight: 500;">{{ucFirst($trans->status)}}</span> 
                                                                @break
                                                            @case('completed')
                                                                <span style="color: #66972b;font-weight: 500;">{{ucFirst($trans->status)}}</span> 
                                                                @break
                                                            @case('failed')
                                                                <span style="color: #ff4313;font-weight: 500;">{{ucFirst($trans->status)}}</span> 
                                                                @break
                                                            @case('pending')
                                                                <span style="color: #edbb27;font-weight: 500;">{{ucFirst($trans->status)}}</span> 
                                                                @break
                                                            @default
                                                                <span style="font-weight: 500;">{{ucFirst($trans->status)}}</span>
                                                        @endswitch
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <h5 class="p-5 text-center" style="color: #476423;">You have no Wallet Transactions</h5>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
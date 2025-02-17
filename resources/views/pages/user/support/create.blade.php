@extends('pages.app')
<link rel="stylesheet" href="{{asset('/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('/css/select2-bootstrap.min.css')}}">
<style>

    .card-header{
        font-family: 'Poppins';
        font-style: normal;
        font-weight: 400;
        font-size: 20px;
        line-height: 60px;
    }
    .form-group {
        transition: .5s;
    }

    input:focus, select:hover, textarea:hover {
        border-color: #6f3c96;
    }

    .title{
        font-size: 2rem;
        line-height: 1em;
        margin: 0;
        font-family: inherit;
        font-weight: 500;
        line-height: 1.2;
        color: #ffffff;
    }

    .error {
        color: red;
        display: block;
        margin-top: .5rem;
    }

    label{
        color: #6f3c96;
    }

    .form-header{
        background: #94CA52;
        height: 165px;
        width: 100%;
        border-radius: 30px 30px 0px 0px;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    .card{
        padding: 0 !important;
        border-radius: 30px !important;
    }

    .card-body{
        padding: 1rem 3rem !important;
    }

</style>
@section('content')

<div class="container-fluid">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <div class="card-header text-uppercase text-snd text-center">How can we help?</div>
                <div class="card shadow">
                    <div class="form-header">
                        <h6 class="fs-4 text-center title">Use the form below to create ticket.</h6>
                        <h6 class="text-center text-white gray-200"> We'll aim to respond within 24 hours. </h6>
                    </div>

                    <div class="card-body">
                        @if (Auth::user()->email_verified_at == NULL)
                            <h6 class="text-center text-muted">Verify your email address</h6>
                            <form action="{{route('user.verify.email')}}" class="mb-0 d-flex justify-content-center"
                                method="POST">
                                @csrf
                                <input type="hidden" name="email" value="{{Auth::user()->email}}">
                                <button type="submit" class="btn btn-primary">Verify Email</button>
                            </form>
                        @else
                            <form id="createTicket" action="{{route('user.support.ticket.store')}}" method="POST">
                                @csrf



                                <div class="form-group">
                                    <label for="">Subject</label>
                                    <input type="text" name="subject" class="form-control" required/>
                                </div>

                                <div class="form-group">
                                    <label for="">Description</label>
                                    <textarea name="description" class="form-control" required></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="">Ticket type</label>
                                    <select name="type" class="form-select" required>
                                        <option value="Question">Question</option>
                                        <option value="Incident">Issue</option>
                                        <option value="incident">Incident</option>
                                        <option value="Problem">Problem</option>
                                        <option value="Feature Request">Feature Request</option>
                                        <option value="Refund">Refund</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">Ticket Category</label>
                                    <select name="category" class="form-select">
                                        <option value="general">General</option>
                                        <option value="account creation">Account creation</option>
                                        <option value="profile">Profile</option>

                                        <option value="job submission">Job submission</option>

                                        <option value="vWallet">vWallet</option>
                                        <option value="payment">Payment</option>
                                        <option value="content">Content</option>
                                        <option value="Dispute and Resolution">Dispute and Resolution</option>
                                        <option value="Vendor station">Vendor station</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">Ticket Priority</label>
                                    <select name="priority" class="form-select">
                                        <option value="high">High</option>
                                        <option value="medium">Medium</option>
                                        <option value="low">Low</option>
                                    </select>

                                </div>

                                <button type="submit" class="btn btn-success btn-snd mt-2 float-right">Create Ticket</button>

                            </form>
                            <div class="form-check pl-0">
                                <label class="form-check-label text-center">
                                <a href="{{route('public.privacy')}}" class="text-main text-center">Privacy Policy</a> and <a href="{{route('public.terms')}}" class="text-main text-center">Terms of Service</a> apply
                                </label>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

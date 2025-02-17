@extends('pages.app')
{{-- <link rel="stylesheet" href="{{asset('/css/select2.min.css')}}"> --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intro.js/2.9.3/introjs.min.css"
    integrity="sha512-DcHJLWkmfnv+isBrT8M3PhKEhsHWhEgulhr8m5EuGhdAG9w+vUyjlwgR4ISLN0+s/m4ItmPsTOqPzW714dtr5w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="{{asset('/css/select2-bootstrap.min.css')}}">
@php
$user = Auth::user();
@endphp
@push('scripts')
<script>
    document.title = "Settings";
</script>
@endpush
@push('css')
<style>
    .v-badge {
        position: absolute;
        right: 10px;
        top: 15px;
        background: rgb(220, 53, 69);
        display: inline-block;
        height: 10px;
        width: 10px;
        border-radius: 50%;
    }

    .introjs-nextbutton {
        -webkit-border-radius: 0 0.2em 0.2em 0;
        -moz-border-radius: 0 .2em .2em 0;
        border-radius: 0 0.2em 0.2em 0;
        background: #28a745 !important;
        color: #fff;
        text-shadow: none;
    }

    .introjs-prevbutton {
        -webkit-border-radius: 0 0.2em 0.2em 0;
        -moz-border-radius: 0 .2em .2em 0;
        border-radius: 0 0.2em 0.2em 0;
        background: #28a745;
        color: #fff;
        text-shadow: none;
    }

    .introjs-skipbutton {
        box-sizing: content-box;
        margin-right: 5px;
        color: #fff;
        background: #6f3a97;
        text-shadow: none;
    }



    .introjs-skipbutton.introjs-donebutton {
        color: #fff;
        background: #44255b !important;
        text-shadow: none;
    }

    .introjs-bullets {
        display: none;
    }


    .twofa-label {
        position: relative;
        width: 60px;
        height: 34px;
        display: inline-block;
        background: #666666;
        border-radius: 30px;
        cursor: pointer;
        transition: all 0.3s;
        -moz-transition: all 0.3s;
        -webkit-transition: all 0.3s;
    }

    .twofa-label:after {
        content: "";
        position: absolute;
        left: 2px;
        top: 2px;
        width: 30px;
        height: 30px;
        background: #94ca52;
        border-radius: 50%;
        box-shadow: 1px 3px 6px #666666;
    }

    #twofa:checked+label {
        background: #6f3c96;
    }

    #twofa {
        display: block;
        opacity: 0;
    }


    #twofa:checked+label:after {
        left: auto;
        right: 2px;
    }


    .port img {
        max-width: 100%;
        display: block;
    }

    .port .card-list {
        width: 90%;
        max-width: 400px;
    }

    .port .card {
        background-color: #FFF;
        box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.05), 0 20px 50px 0 rgba(0, 0, 0, 0.1);
        border-radius: 15px;
        overflow: hidden;
        padding: 1.25rem;
        position: relative;
        transition: 0.15s ease-in;
    }

    .port card:hover,
    .card:focus-within {
        box-shadow: 0 0 0 2px #16C79A, 0 10px 60px 0 rgba(0, 0, 0, 0.1);
        transform: translatey(-5px);
    }

    .port .card-image {
        border-radius: 10px;
        overflow: hidden;
    }

    .port .card-header {
        margin-top: 1.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .port .card-header a {
        font-weight: 600;
        font-size: 1.375rem;
        line-height: 1.25;
        padding-right: 1rem;
        text-decoration: none;
        color: inherit;
        will-change: transform;
    }

    /* .port .card-header a:after {
  content: "";
  position: absolute;
  left: 0;
  top: 0;
  right: 0;
  bottom: 0;
} */

    .port .icon-button {
        border: 0;
        background-color: #fff;
        border-radius: 50%;
        width: 2.5rem;
        height: 2.5rem;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-shrink: 0;
        font-size: 1.25rem;
        transition: 0.25s ease;
        box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.05), 0 3px 8px 0 rgba(0, 0, 0, 0.15);
        z-index: 1;
        cursor: pointer;
        color: #565656;
    }

    .port .icon-button svg {
        width: 1em;
        height: 1em;
    }

    .port .icon-button:hover,
    .icon-button:focus {
        background-color: #703b97;
        color: #FFF;
    }

    .port .card-body::after,
    .card-footer::after,
    .card-header::after {
        display: none;
        clear: both;
        content: none;
    }

    .port .card-footer {
        margin-top: 1.25rem;
        border-top: 1px solid #ddd;
        padding-top: 1.25rem;
        display: flex;
        align-items: center;
        flex-wrap: wrap;
    }

    .port .card-meta {
        display: flex;
        align-items: center;
        color: #787878;
    }

    .port .card-meta:first-child:after {
        display: block;
        content: "";
        width: 4px;
        height: 4px;
        border-radius: 50%;
        background-color: currentcolor;
        margin-left: 0.75rem;
        margin-right: 0.75rem;
    }

    .port .card-meta svg {
        flex-shrink: 0;
        width: 1em;
        height: 1em;
        margin-right: 0.25em;
    }

    .video-component {
        position: relative;
    }

    .thumbnail {
        position: relative;
        display: inline-block;
        width: 100%;
        height: 200px;
    }

    .thumbnail img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .play-button {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 80px;
        height: 80px;
        background-color: rgba(0, 0, 0, 0.5);
        border: none;
        border-radius: 50%;
        color: #fff;
        font-size: 40px;
        cursor: pointer;
    }

    .play-button::before {
        content: '\f04b';
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    video {
        display: none;
        width: 100%;
    }

</style>
@endpush

@section('content')
@include('includes.messages')
@include('includes.uploadPortfolio')
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-sm-12 col-md-3 col-lg-3">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active position-relative" id="v-pills-profile-tab" data-toggle="pill"
                        href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="true">Profile
                        @if (!Auth::user()->country_id)
                        <span class="noti-badge" style="top: 14px; right:10px;"></span>
                        @endif
                    </a>
                    <a class="nav-link" id="v-pills-email-tab" data-toggle="pill" href="#v-pills-email" role="tab"
                        aria-controls="v-pills-email" aria-selected="false">Email and Notification</a>
                    <!-- <a class="nav-link" id="v-pills-membership-tab" data-toggle="pill" href="#v-pills-membership"
                        role="tab" aria-controls="v-pills-membership" aria-selected="false">Membership</a> -->
                    <a class="nav-link" id="v-pills-password-tab" data-toggle="pill" href="#v-pills-password" role="tab"
                        aria-controls="v-pills-password" aria-selected="false">Password</a>
                    <a class="nav-link position-relative" id="v-pills-payment-tab" data-toggle="pill"
                        href="#v-pills-payment" role="tab" aria-controls="v-pills-payment" aria-selected="false">Payment
                        & Financials
                        @if ($subaccounts->count() <= 0) <span class="noti-badge" style="top: 14px; right:10px;"></span>
                            @endif
                    </a>
                    <a class="nav-link" id="v-pills-security-tab" data-toggle="pill" href="#v-pills-security" role="tab"
                        aria-controls="v-pills-security" aria-selected="false">Security</a>
                    <a class="nav-link position-relative" id="v-pills-verification-tab" data-toggle="pill"
                        href="#v-pills-verification" role="tab" aria-controls="v-pills-verification"
                        aria-selected="false">Verification
                        @if (!Auth::user()->email_verified_at || !Auth::user()->isPhoneVerified)
                        <span class="noti-badge" style="top: 14px; right:10px;"></span>
                        @endif
                    </a>
                    @if ($user->hasRole('vendor'))
                    <a class="nav-link" id="v-pills-vendor-tab" data-toggle="pill" href="#v-pills-vendor" role="tab"
                        aria-controls="v-pills-vendor" aria-selected="false">My store</a>
                    @endif

                    @if ($user->hasRole('creative'))
                    <a class="nav-link" id="v-pills-portfolio-tab" data-toggle="pill" href="#v-pills-portfolio"
                        role="tab" aria-controls="v-pills-portfolio" aria-selected="false">My Portfolio</a>
                    @endif
                </div>
            </div>
            <div class="col-sm-12 col-md-9 col-lg-9">
                <div class="tab-content shadow-sm bg-white p-3 tb-custom mt-4" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel"
                        aria-labelledby="v-pills-profile-tab">
                        <div class="card shadow-none">
                            <div class="card-header text-main ch-header">Profile Details <span class="tip"
                                    style="margin-bottom: -5px;"
                                    data-content="Make sure you complete your location information here, specifically the Country!">
                                    <ion-icon name="help-circle-outline" style="margin-bottom: -5px;" size="large">
                                    </ion-icon>
                                </span></div>
                            <div class="card-body">
                                <form action="{{route('user.profile.details')}}" method="POST">
                                    @csrf
                                    <div class="form-row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="text"
                                                    class="form-control @error ('first_name') is-invalid @enderror"
                                                    id="first_name" placeholder="First Name" name="first_name"
                                                    value="{{old('first_name') ? old('first_name') : $user->first_name}}"
                                                    maxlength="30">
                                                <label for="first_name">First Name </label>
                                                @error('first_name')
                                                <div id="first_name" class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" name="last_name" id="last_name"
                                                    class="form-control @error ('last_name') is-invalid @enderror"
                                                    placeholder="Last Name"
                                                    value="{{old('last_name') ? old('last_name') : $user->last_name}}"
                                                    maxlength="30">
                                                <label for="last_name">Last Name </label>
                                                @error('last_name')
                                                <div id="last_name" class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="mt-4">
                                    <label class="position-relative mt-4"><b>Address</b>
                                        @if (!Auth::user()->country_id)
                                        <span class="noti-badge" style="top: 7px; right:-20px;"></span>
                                        @endif
                                    </label>
                                    <div class="form-row">
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group mt-4">
                                                <div class="form-floating mb-3">
                                                    <input type="text" name="address" id="address"
                                                        class="form-control @error ('address') is-invalid @enderror"
                                                        value="{{old('address') ? old('address') : $user->street_address}}"
                                                        placeholder="Address" maxlength="70">
                                                    <label for="address">Address</label>
                                                    @error('address')
                                                    <div id="address" class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-sm-12 col-md-4">
                                            <div class="form-floating mb-3">
                                                <input type="text" name="city" id="city"
                                                    class="form-control @error ('city') is-invalid @enderror"
                                                    value="{{old('city') ? old('city') : $user->city}}"
                                                    placeholder="City" maxlength="30" readonly>
                                                <label for="city">City</label>
                                                @error('city')
                                                <div id="city" class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-4">
                                            <div class="form-floating mb-3">
                                                <input type="text" name="postal_code" id="postal_code"
                                                    class="form-control @error ('postal_code') is-invalid @enderror"
                                                    value="{{old('postal_code') ? old('postal_code') : $user->postal_code}}"
                                                    placeholder="postal_code" readonly>
                                                <label for="postal_code">Postal code</label>
                                                @error('postal_code')
                                                <div id="postal_code" class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-4">
                                            <div class="form-floating mb-3">
                                                <input type="text" name="country" id="country"
                                                    class="form-control @error('country') is-invalid @enderror"
                                                    value="{{ old('country') ? old('country') : (isset($user->country) ? $user->country->name : '') }}"
                                                    placeholder="country" required readonly>
                                                <label for="country">Country</label>
                                                @error('country')
                                                <div id="country" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>


                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success btn-sm">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-email" role="tabpanel" aria-labelledby="v-pills-email-tab">
                        <div class="card shadow-none">
                            <div class="card-header text-main ch-header">Email <span class="tip"
                                    style="margin-bottom: -5px;"
                                    data-content="You will need to add your email details here for the verification.">
                                    <ion-icon name="help-circle-outline" style="margin-bottom: -5px;" size="large">
                                    </ion-icon>
                                </span></div>
                            <div class="card-body">
                                <form action="{{route('user.email.update')}}" method="POST">
                                    @csrf
                                    <div class="form-row">
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <label for="email">Email</label>
                                            <input type="text" name="email"
                                                class="form-control @error ('email') is-invalid @enderror"
                                                value="{{$user->email}}">
                                            @error('email')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <label for="password">Current Password <span
                                                        class="text-sm text-muted font-weight-light">(if you want to
                                                        update your email)</span></label>
                                                <input type="password" name="current_password"
                                                    class="form-control @error ('current_password') is-invalid @enderror">
                                                @error('current_password')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-4">
                                        <button type="submit" class="btn btn-success btn-sm">Update Email
                                            Address</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-membership" role="tabpanel"
                        aria-labelledby="v-pills-membership-tab">
                        <div class="card shadow-none">
                            <div class="card-header text-main ch-header">Membership <span class="tip"
                                    style="margin-bottom: -5px;"
                                    data-content="Manage your membership plan/subscription">
                                    <ion-icon name="help-circle-outline" style="margin-bottom: -5px;" size="large">
                                    </ion-icon>
                                </span></div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div>
                                            <h6 class="font-weight-bold text-main text-uppercase">Current Plan</h6>
                                            <h6 class="plan font-weight-bold text-main text-uppercase">Free</h6>
                                            <p>$0 Per Month</p>
                                            <a href="#" class="btn btn-success btn-sm">Manage</a>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div>
                                            <h6>Billing Information</h6>
                                            <a href="#">View transaction history</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-password" role="tabpanel"
                        aria-labelledby="v-pills-password-tab">
                        <div class="card shadow-none">
                            <div class="card-header text-main ch-header">Password <span class="tip"
                                    style="margin-bottom: -5px;" data-content="Reset your account password">
                                    <ion-icon name="help-circle-outline" style="margin-bottom: -5px;" size="large">
                                    </ion-icon>
                                </span></div>
                            <div class="card-body">
                                <form action="{{route('user.change.password')}}" method="POST">
                                    @csrf
                                    <div class="form-row">
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="old_password">Current Password</label>
                                                <input type="password" name="old_password"
                                                    class="form-control @error ('old_password') is-invalid @enderror">
                                                @error('old_password')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="password">New Password</label>
                                                <input type="password" name="password"
                                                    class="form-control @error ('password') is-invalid @enderror">
                                                @error('password')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="password_confirmation">Confirm Password</label>
                                                <input type="password" name="password_confirmation"
                                                    class="form-control @error ('password_confirmation') is-invalid @enderror">
                                                @error('password_confirmation')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-4">
                                        <button type="submit" class="btn btn-success btn-sm">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-payment" role="tabpanel"
                        aria-labelledby="v-pills-payment-tab">
                        <div class="card shadow-none">
                            <div class="card-header text-main ch-header">Payment Method</div>
                            <div class="card-body">
                                <div class="d-inline-block" style="width: 100%">
                                    <h6 class="position-relative" style="width: 160px;">Add Payment Method
                                        @if ($subaccounts->count() <= 0) <span class="noti-badge"
                                            style="top: 4px; right:-20px;"></span>
                                            @endif
                                    </h6>
                                    <a href="{{  route('user.payment.methods') }}" class="btn btn-primary btn-sm">
                                        <i class="fa fa-plus" aria-hidden="true"></i> &nbsp; Payment Method
                                    </a>
                                    @if ($subaccounts->count() > 0)
                                    <table class="mt-5 d-table table table-hover table-inverse table-responsive">
                                        <thead class="thead-inverse">
                                            <tr>
                                                <th>S/N</th>
                                                <th>Bank</th>
                                                <th>Name</th>
                                                <th>Account No</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($subaccounts as $account)
                                            <tr>
                                                <td scope="row">{{$loop->iteration}}</td>
                                                <td>{{$account->bank_name}}</td>
                                                <td>{{$account->full_name}}</td>
                                                <td>{{$account->account_number}}</td>
                                                <td>
                                                    <form action="{{route('user.subaccount.delete', $account->id)}}"
                                                        class="mb-0" method="post">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-security" role="tabpanel"
                        aria-labelledby="v-pills-security-tab">
                        <div class="card shadow-none">
                            <div class="card-header text-main ch-header">Account Security <span class="tip"
                                    style="margin-bottom: -5px;" data-content="Manage your account security settings">
                                    <ion-icon name="help-circle-outline" style="margin-bottom: -5px;" size="large">
                                    </ion-icon>
                                </span></div>
                            <div class="card-body">
                                <div>
                                    <h6 class="text-lg"> <i class="fa fa-info-circle text-snd" aria-hidden="true"></i>
                                        Two Factor Authentication</h6>
                                    <p>
                                        @if(Auth::user()->two_fa)
                                        Your account two-factor authentication enabled.
                                        @else
                                        Your account does not have two-factor authentication turned on.
                                        @endif <br>
                                        Enabling 2FA will greatly enhance the security of your vicomma account. It's a
                                        simple stemp that can make a big difference in keeping your account safe.
                                    </p>
                                    <div class="d-flex" style="flex-direction: column; gap: 15px;">
                                        <div>
                                            <a href="#">Enable Two Factor Authentication</a>
                                        </div>
                                        <div>
                                            <div>
                                                <input type="checkbox" id="twofa" @if(Auth::user()->two_fa) checked
                                                @endif/>
                                                <label class="twofa-label" for="twofa"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-verification" role="tabpanel"
                        aria-labelledby="v-pills-verification-tab">
                        <div class="card shadow-none">
                            <div class="card-header text-main ch-header">Account Verification <span class="tip"
                                    style="margin-bottom: -5px;"
                                    data-content="You need to confirm your Email and Phone Number here to receive notifications and WhatsApp messages.">
                                    <ion-icon name="help-circle-outline" style="margin-bottom: -5px;" size="large">
                                    </ion-icon>
                                </span></div>
                            <div class="card-body p-0">
                                <div class="d-flex justify-content-between accVcontainer p-4">
                                    <div>
                                        <h6>Email Address</h6>
                                    </div>
                                    <div>
                                        @if ($user->email_verified_at != NULL)
                                        <h6 class="text-success text-uppercase text-sm"> <i class="fa fa-check-circle"
                                                aria-hidden="true"></i> Verified</h6>
                                        @else
                                        <form action="{{route('user.verify.email')}}" class="mb-0" method="POST">
                                            @csrf
                                            <input type="hidden" name="email" value="{{$user->email}}">
                                            <button type="submit" class="btn btn-primary btn-sm">Email</button>
                                        </form>
                                        @endif
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between accVcontainer p-4">
                                    <div>
                                        <h6>Phone Number</h6>
                                    </div>
                                    <div>
                                        @if ($user->isPhoneVerified)
                                        <h6 class="text-success text-uppercase text-sm"> <i class="fa fa-check-circle"
                                                aria-hidden="true"></i> Verified</h6>
                                        @else
                                        <a href="#" class="btn btn-success btn-sm" data-toggle="modal"
                                            data-target="#phoneNumberModal"> <i class="fa fa-plus"
                                                aria-hidden="true"></i>
                                            Add Phone Number</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between accVcontainer p-4">
                                    <div>
                                        <h6>Twitter</h6>
                                    </div>
                                    <div>
                                        @if ($user->twitter != NULL)
                                        <a href="#" class="btn btn-twitter btn-primary btn-sm"> <i
                                                class="fab fa-twitter" aria-hidden="true"></i> Twitter</a>
                                        @else
                                        <a href="{{route('login.twitter')}}" class="btn btn-twitter btn-primary btn-sm">
                                            <i class="fab fa-twitter" aria-hidden="true"></i> Twitter
                                        </a>
                                        @endif
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between accVcontainer p-4">
                                    <div>
                                        <h6>Instagram</h6>
                                    </div>
                                    <div>
                                        @if ($user->instagram != NULL)
                                        <h6 class="text-snd text-uppercase text-sm"> <i class="fab fa-instagram"
                                                aria-hidden="true"></i> {{$user->instagram}}</h6>
                                        @else
                                        <a href="{{route('login.instagram')}}"
                                            class="btn btn-instagram btn-primary btn-sm">
                                            <i class="fab fa-instagram" aria-hidden="true"></i> Instagram
                                        </a>
                                        @endif
                                        {{-- Instagram Modal --}}
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between accVcontainer p-4">
                                    <div>
                                        <h6>Facebook</h6>
                                    </div>
                                    <div>
                                        @if ($user->facebook != NULL)
                                        <h6 class="text-snd text-uppercase text-sm"> <i class="fab fa-facebook"
                                                aria-hidden="true"></i> {{$user->facebook}}</h6>
                                        @else
                                        <a href="{{route('login.facebook.verif')}}"
                                            class="btn btn-facebook btn-primary btn-sm"> <i class="fab fa-facebook"
                                                aria-hidden="true"></i> Facebook</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($user->hasRole('vendor'))
                    <div class="tab-pane fade" id="v-pills-vendor" role="tabpanel" aria-labelledby="v-pills-vendor-tab">
                        <div class="card shadow-none">
                            <div class="card-header text-main ch-header">My Store Details <span class="tip"
                                    style="margin-bottom: -5px;" data-show="no" data-content="Manage Your Online Store">
                                    <ion-icon name="help-circle-outline" style="margin-bottom: -5px;" size="large">
                                    </ion-icon>
                                </span></div>
                            <div class="card-body">
                                <form action="{{route('user.vendor.update.details')}}" method="POST">
                                    @csrf
                                    <div class="form-row">
                                        <div class="col-sm-12 col-md-6">
                                            <label for="station">Store Name</label>
                                            <input type="text" name="station" id="station"
                                                class="form-control @error ('station') is-invalid @enderror"
                                                value="{{$user->vendor->vendor_station}}" readonly>
                                            <small class="text-muted">The store name cannot be updated</small>
                                            @error('station')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if ($user->hasRole('creative'))
                    <div class="tab-pane fade" id="v-pills-portfolio" role="tabpanel"
                        aria-labelledby="v-pills-portfolio-tab">
                        <div class="card shadow-none">
                            <div class="card-header text-main ch-header">My Portfolio <span class="tip"
                                    style="margin-bottom: -5px;" data-show="no" data-content="Manage your portfolio">
                                    <ion-icon name="videocam" style="margin-bottom: -5px;" size="large"></ion-icon>
                                </span></div>
                            <div class="card-body">
                                <div style="display: flex; align-items: center; justify-content: space-between;">
                                    <p class="small mb-0">Your porfolio will give more info to vendors.</p>
                                    @if(count($portfolio) < 4)<a href="#" class="btn btn-primary btn-sm"
                                        data-bs-toggle="modal" data-bs-target="#fileUpload">Add to Portfolio</a>@endif
                                </div>
                                <br />

                                @if(count($portfolio) > 0)
                                <div class="row port" style="gap: 10px;flex-wrap: nowrap;">
                                    @foreach($portfolio as $item)
                                    <article class="card col-md-6">
                                        <figure class="card-image">
                                            <div class="video-component">
                                                <div class="thumbnail">
                                                    <img src="{{$item->thumbnail}}" alt="Video Thumbnail">
                                                    <button class="play-button"></button>
                                                </div>
                                                <video controls>
                                                    <source src="{{$item->file}}" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                            </div>
                                            <!-- <img src="https://images.unsplash.com/photo-1494253109108-2e30c049369b?crop=entropy&cs=srgb&fm=jpg&ixid=MnwxNDU4OXwwfDF8cmFuZG9tfHx8fHx8fHx8MTYyNDcwMTUwOQ&ixlib=rb-1.2.1&q=85" alt="An orange painted blue, cut in half laying on a blue background" /> -->
                                        </figure>
                                        <div class="card-header px-1">
                                            <a href="#">{{$item->name}}</a>
                                            <button class="icon-button" onclick="window.open('{{$item->link}}')">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    display="block" id="Heart">
                                                    <path
                                                        d="M7 3C4.239 3 2 5.216 2 7.95c0 2.207.875 7.445 9.488 12.74a.985.985 0 0 0 1.024 0C21.125 15.395 22 10.157 22 7.95 22 5.216 19.761 3 17 3s-5 3-5 3-2.239-3-5-3z" />
                                                </svg>

                                            </button>
                                        </div>
                                        <div class="card-body px-1">
                                            <p class="smal mt-2 mb-1">{{$item->description}}</p>
                                        </div>
                                        <div class="card-footer">
                                            <div class="card-meta card-meta--views">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    display="block" id="EyeOpen">
                                                    <path
                                                        d="M21.257 10.962c.474.62.474 1.457 0 2.076C19.764 14.987 16.182 19 12 19c-4.182 0-7.764-4.013-9.257-5.962a1.692 1.692 0 0 1 0-2.076C4.236 9.013 7.818 5 12 5c4.182 0 7.764 4.013 9.257 5.962z" />
                                                    <circle cx="12" cy="12" r="3" />
                                                </svg>
                                                {{$item->views}}
                                            </div>
                                            <div class="card-meta card-meta--date">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    display="block" id="Calendar">
                                                    <rect x="2" y="4" width="20" height="18" rx="4" />
                                                    <path d="M8 2v4" />
                                                    <path d="M16 2v4" />
                                                    <path d="M2 10h20" />
                                                </svg>
                                                {{\Carbon\Carbon::parse($item->created_at)->format('F d, Y')}}
                                            </div>
                                        </div>
                                    </article>
                                    @endforeach
                                </div>

                                @else
                                <center style="margin-bottom: 40px; margin-top: 40px">
                                    <img src="/portf.svg" style="height: 180px;" />

                                    <p class="small mt-3">You do not have an item in your portfolio yet.</p>
                                </center>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    @if ($user->country)
    <update-phone-number v-bind:country={{$user->country->phone_code}}></update-phone-number>
    @else
    <!-- Modal -->
    <div class="modal fade verifyCountryModal" id="phoneNumberModal" tabindex="-1"
        aria-labelledby="phoneNumberModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="phoneNumberModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6 class="text-center">You need to add your country first</h6>
                    <a class="btn btn-success btn-block mt-3 cls" id="v-pills-profile-tab" data-toggle="pill"
                        href="#v-pills-profile">Proceed</a>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>


@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/intro.js/2.9.3/intro.min.js"
    integrity="sha512-VTd65gL0pCLNPv5Bsf5LNfKbL8/odPq0bLQ4u226UNmT7SzE4xk+5ckLNMuksNTux/pDLMtxYuf0Copz8zMsSA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
{{-- <script src="{{asset('/js/select2.min.js')}}"></script> --}}
<!-- <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAMkyJj24r8B-6akyuUc8MFKaFfTMxyeiU&libraries=places&callback=initAutocomplete"></script> -->

<script async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB39R7H9RPMtEOomFpEdRfgjFJF9Uxh9OA&libraries=places&callback=initAutocomplete">
</script>

<script>
    //new comment
let autocomplete;
    function initAutocomplete() {
        autocomplete = new google.maps.places. Autocomplete (
        document.getElementById('address'),
        {
            types: ['establishment'],
            componentRestrictions: {'country': ['US', 'NG']},
            fields: ['geometry', 'formatted_address', 'address_components']
        });
        autocomplete.addListener('place_changed', onPlaceChanged);
        function onPlaceChanged() {
            let place = autocomplete.getPlace();
            let address = place.address_components;
            let city = document.getElementById('city');
            let zip = document.getElementById('postal_code');
            let country = document.getElementById('country');
            if (!place.geometry) {
            // User did not select a prediction; reset the input field
                document.getElementById('address').placeholder ='Enter a place';
            } else {
                for (let i = 0; i < address.length; i++) {
                    if (address[i].types[0] === 'locality') {
                        cityname = address[i].long_name;
                    }
                    if (address[i].types[0] === 'postal_code') {
                        zipname = address[i].long_name;
                    }
                    if (address[i].types[0] === 'country') {
                        countryname = address[i].long_name;
                    }
                }
                city.value = cityname;
                zip.value = zipname;
                country.value = countryname;
                console.log([cityname, zipname, countryname]);
            }
            // Display details about the valid place
            // document.getElementById('details').innerHTML = place.name;
        }
        // function fillInAddress() {
        //     let place = autocomplete.getPlace();
        //     let address = place.address_components;
        //     let city = '';
        //     let state = '';
        //     let zip = '';
        //     let country = '';
        //     let lat = place.geometry.location.lat();
        //     let lng = place.geometry.location.lng();
        //     let place_id = place.place_id;
        //     let name = place.name;
        //     for (let i = 0; i < address.length; i++) {
        //         if (address[i].types[0] === 'locality') {
        //             city = address[i].long_name;
        //         }
        //         if (address[i].types[0] === 'administrative_area_level_1') {
        //             state = address[i].long_name;
        //         }
        //         if (address[i].types[0] === 'postal_code') {
        //             zip = address[i].long_name;
        //         }
        //         if (address[i].types[0] === 'country') {
        //             country = address[i].long_name;
        //         }
        //     }
        //     $('#city').val(city);
        //     $('#state').val(state);
        //     $('#zip').val(zip);
        //     $('#country').val(country);
        //     $('#lat').val(lat);
        //     $('#lng').val(lng);
        //     $('#place_id').val(place_id);
        //     $('#name').val(name);
        // }
    }
</script>

<script>
    @if (!Auth::user()->country_id || $subaccounts->count() < 1 || !Auth::user()->email_verified_at)
jQuery(document).ready(function() {
setTimeout(() => {
        $('#v-pills-profile-tab').tab('show');
        if(localStorage.getItem("tour_2") && localStorage.getItem("tour_1") == 'yes'){
        return false;        
        }
        if(swal.getState().isOpen == true){
    swal.close()
}


        setTimeout(() => {
            var intro = introJs();
    intro.setOptions({
      doneLabel: 'Got It',
      showStepNumbers: false,
      steps: [
      {
        element: document.querySelector('#v-pills-tabContent'),
        intro: "Make sure you complete your location information here, specifically the Country!",
        position: 'left'
      },
      ]
    });
    intro.start().oncomplete(function() {
        $('#v-pills-email-tab').tab('show');
        setTimeout(() => {
            var intro2 = introJs();
    intro2.setOptions({
      doneLabel: 'Got It',
      showStepNumbers: false,
      steps: [
      {
        element: document.querySelector('#v-pills-tabContent'),
        intro: "You will need to add your email details here for the verification to occur.",
        position: 'left'
      },
      ]
    });
    intro2.start().oncomplete(function() {
        $('#v-pills-payment-tab').tab('show');
        setTimeout(() => {
            var intro3 = introJs();
    intro3.setOptions({
      doneLabel: 'Got It',
      showStepNumbers: false,
      steps: [
      {
        element: document.querySelector('#v-pills-tabContent'),
        intro: @if(auth()->user()->hasRole('vendor')) " Make sure to add a Payment Method so that you can pay and receive your content!" @else "Make sure to add a Payment Method so that you can get paid for your work!" @endif,
        position: 'left'
      },
      ]
    });
    intro3.start().oncomplete(function() {
        $('#v-pills-verification-tab').tab('show');
        setTimeout(() => {
            var intro4 = introJs();
    intro4.setOptions({
      doneLabel: 'Got it',
      showStepNumbers: false,
      steps: [
      {
        element: document.querySelector('#v-pills-tabContent'),
        intro: "You need to confirm your Email and Phone Number here to receive notifications and WhatsApp messages.",
        position: 'left'
      },
      ]
    });
    intro4.start().oncomplete(function() {
        localStorage.setItem("tour_2", "yes")
    });
        }, 1000)


    });
        }, 1000)


    });
        }, 1000);
    });
        }, 1000);
    }, 3000);
})
@endif
jQuery(document).ready(function() {
    jQuery('.cls').on('click', function() {
        $('.verifyCountryModal').hide()
        $(".modal-backdrop").remove()
    })
    // $('.country').select2({
    //     theme: 'bootstrap4'
    // })
})
//Tabs
$('a[data-toggle="pill"]').on('show.bs.tab', function(e) {
    localStorage.setItem('activePill', $(e.target).attr('href'));
});
var activePill = localStorage.getItem('activePill');
if (activePill) {
    $('#v-pills-tab a[href="' + activePill + '"]').tab('show');
}


$('#twofa').on('change', function(event) {
    // Send AJAX request to enable or disable 2FA based on switch state
    $.ajax({
      url: '/twofa-toggle',
      type: 'POST',
      data: { 
          "_token": "{{ csrf_token() }}",
          "id": "{{Auth::user()->id}}"
       },
      success: function(response) {
        // Handle successful response
        localStorage.setItem('activePill', "#v-pills-security");
        location.reload()
      },
      error: function(xhr, status, error) {
        // Handle error
      }
    });
  });
  $(document).ready(function() {
  $('.play-button').on('click', function() {
    var thumbnail = $(this).parent('.thumbnail');
    console.log(this, thumbnail)
    var video = thumbnail.siblings('video');

    thumbnail.hide();
    video.show();
    video.get(0).play();
  });
});
</script>
@endpush
@endsection
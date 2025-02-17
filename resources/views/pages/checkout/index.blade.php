@extends('pages.app')
<link rel="stylesheet" href="{{asset('/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('/css/select2-bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('/css/mall-navigation.css')}}">
<link rel="stylesheet" href="{{asset('/ecommerce/css/tailwind.min.css')}}">
<link href="{{asset('/ecommerce/fonts/fontawesome/css/all.min.css')}}" type="text/css" rel="stylesheet" />
<style>
    .payment-info {
  background: #66972B;
  padding: 10px;
  border-radius: 6px;
  color: #fff;
  font-weight: bold;
}

.product-details {
  padding: 10px;
}

body {
  background: #eee;
}

.cart {
  background: #fff;
}

.p-about {
  font-size: 12px;
}

.table-shadow {
  -webkit-box-shadow: 5px 5px 15px -2px rgba(0,0,0,0.42);
  box-shadow: 5px 5px 15px -2px rgba(0,0,0,0.42);
}

.type {
  font-weight: 400;
  font-size: 10px;
}

label.radio {
  cursor: pointer;
}

label.radio input {
  position: absolute;
  top: 0;
  left: 0;
  visibility: hidden;
  pointer-events: none;
}

label.radio span {
  padding: 1px 12px;
  border: 2px solid #ada9a9;
  display: inline-block;
  color: #8f37aa;
  border-radius: 3px;
  text-transform: uppercase;
  font-size: 11px;
  font-weight: 300;
}

label.radio input:checked + span {
  border-color: #fff;
  background-color: blue;
  color: #fff;
}

.credit-inputs {
  background: rgb(102,102,221);
  color: #fff !important;
  border-color: rgb(102,102,221);
}

.credit-inputs::placeholder {
  color: #fff;
  font-size: 13px;
}

.credit-card-label {
  font-size: 9px;
  font-weight: 300;
}

.form-control.credit-inputs:focus {
  background: rgb(102,102,221);
  border: rgb(102,102,221);
}

.line {
  border-bottom: 1px solid rgb(102,102,221);
}

.information span {
  font-size: 12px;
  font-weight: 500;
}

.information {
  margin-bottom: 5px;
}

.items {
  -webkit-box-shadow: 5px 5px 4px -1px rgba(0,0,0,0.25);
  box-shadow: 5px 5px 4px -1px rgba(0, 0, 0, 0.08);
}

.spec {
  font-size: 11px;
}
.form-group {
    transition: .5s;
}

.error {
    color: red;
    display: block;
    margin-top: .5rem;
}

.mantine-vbfevd .mantine-ref_stepIcon_1 {
    border-color: #94ca52 !important;
}

.mantine-5a4wae .mantine-ref_stepIcon_1 {
    background-color: #94ca52 !important;
    border-color: #94ca52 !important;
}

.mantine-1btvzf8 {
    background-color: #94ca52 !important;
}

</style>
@section('content')
@include('includes.messages')
<div class="row">

    <div id="checkout-module" class="align-self-center p-4 px-4" style="padding-top: 0em !important;"></div>

</div>

{{-- {{dd($isLoggedIn)}} --}}
@endsection

@push('scripts')
<script>
var isLoggedIn = "{{ $isLoggedIn }}";
var stuff = "{{ $cart }}";

if (isLoggedIn && stuff == "API") {
    CurrentUserId = isLoggedIn
} else {
    CurrentUserId = "Guest"
}
</script>
<script src="https://checkout.flutterwave.com/v3.js"></script>
<script src="{{ asset('client/checkout/index.js') }}"></script>

@endpush

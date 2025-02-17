@extends('pages.app')
<link
  rel="stylesheet"
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
/>
<style>
    .error {
        font-weight: 400 !important;
        font-size: 12px;
        color: red;
    }
    
    .css-1aquho2-MuiTabs-indicator {
        background-color: #6F408E !important;
    }

    .css-1h9z7r5-MuiButtonBase-root-MuiTab-root.Mui-selected {
        color: #6F408E !important;
    }

    .top-section {
        font-weight: 700 !important;
        font-size: larger;
    }

    .main-heading {
        color: #6F408E;
    }

</style>

@section('content')
@include('includes.messages')
<div class="container-fluid">
    <div class="row">
        <div id="influencer-plans"></div>
    </div>
</div>

<!-- <script src="{{ asset('client/plans/index.js') }}"></script> -->
@endsection
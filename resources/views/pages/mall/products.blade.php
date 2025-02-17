@extends('pages.app')
<link rel="stylesheet" href="{{asset('/css/mall-navigation.css')}}">
<link rel="stylesheet" href="{{asset('/ecommerce/css/tailwind.min.css')}}">
<link href="{{asset('/ecommerce/fonts/fontawesome/css/all.min.css')}}" type="text/css" rel="stylesheet" />
<style>
    .css-jue3ft-MuiRating-root.Mui-disabled {
        opacity: 1 !important;
    }

    .mantine-uwf73j {
        background-color: #94CA52;
    }

    .productsApp {
        padding: 2em;
    }

    .MuiRating-root label:not(.form-check-label):not(.custom-file-label) {
        font-weight: 400;
        font-size: 1.5rem !important;
    }

    .mantine-18sri6z {
        background-color: #94CA52;
        color: #fff;
    }

    .mantine-g5v6wj {
        background-color: #94CA52;
    }

</style>
<script src="{{ asset('client/products/index.js') }}" defer></script>
@section('content')
<div>
    @include('includes.mall-navigation')

    <div id="products-app" class="container-fluid">
        <h1>Products</h1>
    </div>

</div>


@push('scripts')
<script>

</script>
@endpush

@endsection
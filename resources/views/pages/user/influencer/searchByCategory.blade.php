@extends('pages.app')
<style>

</style>
@section('content')
@include('includes.messages')

<div>

    <div id="jobSearchByCategory-module">
        <center>
            <div class="spinner-grow align-items-center" style="width: 3rem; height: 3rem;" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </center>
    </div>

    <script>
    var availableCategoriesEndpoint = "{{ route('user.category.available') }}";
    var categories = [];

    const addCategories = (cat) => {
        categories.push(cat);
    }

    fetch(availableCategoriesEndpoint).then(data => data.json()).then(res => {
        res.data.forEach(cat => {
            cat.count = 235;
            addCategories(cat)
        });
    });
    </script>

</div>

@push('scripts')

<script src="{{ asset('client/categories/index.js') }}"></script>

@endpush
@endsection

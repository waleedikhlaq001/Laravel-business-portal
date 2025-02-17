@extends('pages.app')
@section('content')
@include('includes.messages')
<div class="container-fluid" id="jobs">
    <div class="contactFreelancersContainer">
        <h6>Available Jobs</h6>
        <p class="mt-4">
            List of jobs available, select a job to view more details
        </p>
        <div class="row">
            <div class="col-md-6">
                @if (Auth::user()->hasRole('vendor'))
                    <a href="{{route('user.vendor.jobs.index')}}" class="btn btn-primary btn-sm">Post a job</a>
                @endif
            </div>
            <div class="col-md-6">
                <div class="text-white text-right">
                    <span>Open<sup><span class="badge badge-pill badge-success">{{$open}}</span></sup></span>
                    <span> | Awarded<sup><span class="badge badge-pill badge-danger">{{$awarded}}</span></sup></span>
                    <span> | Total<sup><span class="badge badge-pill badge-light">{{$total}}</span></sup></span>
                </div>
            </div>
        </div>
    </div>
    {{-- <jobs-list v-bind:authUser="{{Auth::user()->id}}"></jobs-list> --}}
    <jobs-list :auth_id="{{Auth::user()->id}}"></jobs-list>
    <div class="m-5"></div>
</div>
@endsection
@push('styles')

<style type="text/css">
   @media only screen and (max-width: 690px) {
        .jbContainer {
            margin-top: -5rem;
        }
        .cofDETAILS::after {
            display: none;
        }
    }
    @media only screen and (min-device-width: 768px) and (-webkit-min-device-pixel-ratio: 1) {
        .jbContainer {
            margin-top: -10rem !important;
        }
    }
    @media screen and (max-width: 800px) {
        .jbContainer {
            margin-top: -10rem;
        }
    }
</style>
@endpush

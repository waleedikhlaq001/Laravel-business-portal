@extends('admin.app')
@section('content')
@include('includes.messages')
<div class="container-fluid">
    <div class="row">
       <div class="col-12">
       <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Jobs</li>
        </ol>
        </nav>
       </div>
        <div class="col-12">
           <vue-progress-bar></vue-progress-bar>
           <jobs-management-component></jobs-management-component>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->
@endsection
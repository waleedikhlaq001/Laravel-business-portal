@extends('admin.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Users</li>
            </ol>
        </nav>
        <div class="col-lg-12 col-12">
            <vue-progress-bar></vue-progress-bar>
           <users-management-component></users-management-component>
        </div>
        <!-- ./col -->
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->
@endsection
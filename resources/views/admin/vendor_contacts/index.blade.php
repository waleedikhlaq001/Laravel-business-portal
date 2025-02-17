@extends('admin.app')
@push("css")
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
@endpush
@section('content')
<div class="container-fluid">
    <div class="row">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Ambassadors</li>
            </ol>
        </nav>
        <div class="col-lg-12 col-12 card py-3 px-3">
            <div class="flex" style="gap: 20px;">
            <h3>Vendor Contacts</h3>
</div>
        <table id="users-table" class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Whatsapp Number</th>
                    <th>Business Name</th>
                    <th>Product/Service/Brand</th>
                    <!-- <th>Socials</th> -->
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->whatsapp }}</td>
                        <td>{{ $user->whatsapp }}</td>
                        <td>{{ $user->business }}</td>
                        <td>{{ $user->service }}</td>
                        <!-- <td>{{ $user->socials }}</td> -->
                     
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
        <!-- ./col -->
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@push("scripts")
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
  
<script>
        $(document).ready(function() {
            $('#users-table').DataTable();
        });
    </script>
@endpush
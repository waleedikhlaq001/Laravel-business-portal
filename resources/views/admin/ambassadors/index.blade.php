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
            <h3>Ambassadors</h3>
            <a href="/admin/ambassadors/notifications" class="btn btn-primary my-3">Notifications for ambassadors</a>
</div>
        <table id="users-table" class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone_number }}</td>
                        <td>{{ $user->street_address }}</td>
                        <td>  @if ($user->status == 1)
                                <span class="badge bg-success">Active</span>
                            @elseif ($user->status == 0)
                                <span class="badge bg-warning text-dark">Pending</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif</td>
                    <td>
                            <a href="/admin/ambassadors/{{$user->id}}" class="btn btn-info">View User</a>
                        </td>
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
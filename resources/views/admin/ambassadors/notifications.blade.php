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
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Notification</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form onsubmit="sub(event)">
      <div class="modal-body">
      <div class="">
              <label for="title" class="form-label fw-bold form-head">Title</label>
            <input type="text" name="title" id="title" required class="form-control driver-form input-title rounded-3" placeholder="Title" />
            </div>
            <div class="pt-3">
              <label for="body" class="form-label fw-bold form-head">Description</label>
            <textarea rows="5" id="body" name="body" required class="form-control driver-form input-title rounded-3" placeholder="Notification Body"></textarea>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      <form>
    </div>
  </div>
</div>
        <div class="flex" style="gap: 20px;">
         <h3>Ambassadors</h3>
            <a href="#" class="btn btn-primary my-3"  data-toggle="modal" data-target="#exampleModal">Add Notification</a>
</div>
        <table id="users-table" class="table table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Body</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $noti)
                    <tr>
                        <td>{{ $noti->title }}</td>
                        <td>{{ $noti->text }}</td>
                    <td>
                            <a href="/admin/delete-noti/{{$noti->id}}" class="btn btn-danger"> delete</a>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
        $(document).ready(function() {
            $('#users-table').DataTable();
        });

        const sub = (event) => {
        event.preventDefault()
        var title = $("#title").val()
        var body = $("#body").val()
        $("button").attr("disabled",true)
        $.post('/admin/add-notification',{
          title,
          body,
          "_token":"{{csrf_token()}}"
        }).done((res)=>{
            Swal.fire("",res.message,"success")
            setTimeout(()=>{
              location.reload()
            },2300)
        }).fail((err)=>{
          $("button").attr("disabled",false)
            Swal.fire("",err.responseJSON.message,"error")
        })
    }
    </script>
@endpush
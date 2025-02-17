@extends('admin.app')
@section('content')
@include('includes.messages')
<div class="container-fluid">
    <h1>Edit Team</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4">

                <!--main content starts here-->
                <div class="row">
                    <?php
                    foreach($team as $rec){
                        $id = $rec['id'];
                        $name = $rec['name'];
                        $image = $rec['image'];
                        $position = $rec['position'];
                        $heirachy = $rec['hierachy'];
                        $tw_link = $rec['tw_link'];
                        $fb_link = $rec['fb_link'];
                        $insta_link = $rec['insta_link'];
                    }
                    ?>
                    <div class="col-md-6 m-auto">
                        <!--fluid space-->
                        <h3>Edit {{$name}}'s Profile</h3>
                        <form method="post" action="" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{$id}}">
                            <div class="form-group">
                                <label class="w-100">Image</label>
                                <img src="{{$image}}" class="img-fluid">
                                <input type="file" name="pic" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="c_name" value="{{$name}}" required="required" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Position</label>
                                <input type="text" name="position" value="{{$position}}" required="required" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Staff Hierachy</label>
                                <input type="text" name="hierachy" value="{{$heirachy}}" placeholder="e.g A" required="required" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>FB Link</label>
                                <input type="text" name="fb" value="{{$fb_link}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Twitter Link</label>
                                <input type="text" name="tw" value="{{$tw_link}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Insta Link</label>
                                <input type="text" name="insta" value="{{$insta_link}}" class="form-control">
                            </div>

                            <div class="form-group">
                                <input type="submit" name="editTeamBtn" class="btn btn-success" value="Save Changes">
                            </div>
                        </form>

                    </div>

                </div>
                <!--end of main contents-->

            </div>
        </div>
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

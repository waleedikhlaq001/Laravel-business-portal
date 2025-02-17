@extends('admin.app')
@section('content')
@include('includes.messages')
<div class="container-fluid">
    <h1>Manage Team</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card p-4">

                <!--main content starts here-->
                <div class="row">

                    <div class="col-md-4">
                        <!--fluid space-->
                        <h3>Add to Team</h3>
                        <form method="post" action="" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" name="pic" required="required" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="c_name" required="required" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Position</label>
                                <input type="text" name="position" required="required" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Staff Hierachy</label>
                                <input type="text" name="hierachy" placeholder="e.g A" required="required" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>FB Link</label>
                                <input type="text" name="fb" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Twitter Link</label>
                                <input type="text" name="tw" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Insta Link</label>
                                <input type="text" name="insta" class="form-control">
                            </div>

                            <div class="form-group">
                                <input type="submit" name="addTeamBtn" class="btn btn-success" value="Save">
                            </div>
                        </form>

                    </div>

                    <div class="col-md-8">
                        <!--fluid space-->
                        <h3>Team Members</h3>

                        <div class="row p-2">
                        <?php
                            $dir = url("img/teams/");

                            if(count($team) > 0){
                                foreach($team as $rec){
                                    $i = $rec['id'];
                                    $image = $rec['image'];
                                    ?>

                                    <div class="col-md-4">

                                        <img id="image<?=$i;?>" src="{{$image}}" height="150px" style="float: left; width: 100%;object-fit:contain;margin-bottom:5px">
                                        <p class="text-center"><b></b></p>
                                        <p class="text-center"><i></i></p>
                                        <div style="width: 100%;"><button onclick="rmvTeamImg('<?=$i;?>')" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button> | <button onclick="editTeam(<?=$i;?>)" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></button></div>

                                    </div>

                                    <?php
                                }
                            }
                        ?>
                        </div>

                    </div>

                </div>
                <!--end of main contents-->

            </div>
        </div>
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->
@endsection
@push("scripts")
<script>
    function editTeam(id){
        location.assign("editTeam/"+id);
    }
    function rmvTeamImg(f){
        if(confirm("Are you sure you want to remove this team profile?")){
            location.assign("deleteTeam/"+f);
        }
    }
</script>
@endpush

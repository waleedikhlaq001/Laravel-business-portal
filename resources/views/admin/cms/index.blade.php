@extends('admin.app')
@section('content')
<div class="container-fluid">
    <div class="row">
    <div class="col-12 col-sm-12 col-lg-12">
      <h2 class="text-muted">Public Content Management </h2> 
      <ul class="list-group">
        <a href="#" style="background-color: #ededed;border: 2px solid #94ca52;" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">  
          <div class="flex-column">
            <h4 style="color: #6f3c96; font-weight: bold">About Us Page</h4>
            <p><small>Content Management</small></p>
          </div>
          <div class="image-parent">
          <button onclick="location.href = '/admin/cms/about';" style="cursor: pointer;"  class="btn btn-secondary btn-sm">
              Edit <i class="fas fa-pencil fa-pen fa-fw"></i></button>
          </div>
        </a>

        <a href="#" style="background-color: #ededed;border: 2px solid #94ca52;" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">  
          <div class="flex-column">
            <h4 style="color: #6f3c96; font-weight: bold">Acceptable Use Policy Page</h4>
            <p><small>Content Management</small></p>
          </div>
          <div class="image-parent">
          <button onclick="location.href = '/admin/cms/acceptable-use';" style="cursor: pointer;"  class="btn btn-secondary btn-sm">
              Edit <i class="fas fa-pencil fa-pen fa-fw"></i></button>
          </div>
        </a>
        <a href="#" style="background-color: #ededed;border: 2px solid #94ca52;" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center disabled">  
          <div class="flex-column">
            <h4 style="color: #6f3c96; font-weight: bold">FAQ Page</h4>
            <p><small>Content Management</small></p>
          </div>
          <div class="image-parent">
          <button style="cursor: pointer;"  class="btn btn-secondary btn-sm">
              Edit <i class="fas fa-pencil fa-pen fa-fw"></i></button>
          </div>
        </a>
        <a href="#" style="background-color: #ededed;border: 2px solid #94ca52;" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">  
          <div class="flex-column">
            <h4 style="color: #6f3c96; font-weight: bold">Privacy Policy Page</h4>
            <p><small>Content Management</small></p>
          </div>
          <div class="image-parent">
          <button onclick="location.href = '/admin/cms/privacy';" style="cursor: pointer;"  class="btn btn-secondary btn-sm">
              Edit <i class="fas fa-pencil fa-pen fa-fw"></i></button>
          </div>
        </a>
        <a href="#" style="background-color: #ededed;border: 2px solid #94ca52;" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">  
          <div class="flex-column">
            <h4 style="color: #6f3c96; font-weight: bold">Vendor and user Information Page</h4>
            <p><small>Content Management</small></p>
          </div>
          <div class="image-parent">
          <button onclick="location.href = '/admin/cms/vendor';" style="cursor: pointer;"  class="btn btn-secondary btn-sm">
              Edit <i class="fas fa-pencil fa-pen fa-fw"></i></button>
          </div>
        </a>
        <a href="#" style="background-color: #ededed;border: 2px solid #94ca52;" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">  
          <div class="flex-column">
            <h4 style="color: #6f3c96; font-weight: bold">Online Video Submission Agreement Page</h4>
            <p><small>Content Management</small></p>
          </div>
          <div class="image-parent">
          <button onclick="location.href = '/admin/cms/online';" style="cursor: pointer;"  class="btn btn-secondary btn-sm">
              Edit <i class="fas fa-pencil fa-pen fa-fw"></i></button>
          </div>
        </a>
        <a href="#" style="background-color: #ededed;border: 2px solid #94ca52;" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">  
          <div class="flex-column">
            <h4 style="color: #6f3c96; font-weight: bold">Terms and Conditions Page</h4>
            <p><small>Content Management</small></p>
          </div>
          <div class="image-parent">
          <button onclick="location.href = '/admin/cms/terms';" style="cursor: pointer;"  class="btn btn-secondary btn-sm">
              Edit <i class="fas fa-pencil fa-pen fa-fw"></i></button>
          </div>
        </a>
      </ul>
    </div>
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->
@endsection
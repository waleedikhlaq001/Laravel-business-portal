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
                <li class="breadcrumb-item active" aria-current="page">{{$user->name}}</li>
            </ol>
        </nav>
        <div class="col-lg-12 col-12 card py-3 px-3">
        <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body py-0">
              <ul class="nav nav-tabs profile-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <a class="nav-link active" id="profile-tab-1" data-bs-toggle="tab" href="#profile-1" role="tab" aria-selected="true">
                    <i class="bi tibibi-user me-2"></i>Profile
                  </a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="profile-tab-2" data-bs-toggle="tab" href="#profile-2" role="tab" aria-selected="false" tabindex="-1">
                    <i class="bi bi-settings me-2"></i>Transactions
                  </a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="profile-tab-3" data-bs-toggle="tab" href="#profile-3" role="tab" aria-selected="false" tabindex="-1">
                    <i class="ti ti-id me-2"></i>Referred Users
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <div class="tab-content">
            <div class="tab-pane active show" id="profile-1" role="tabpanel" aria-labelledby="profile-tab-1">
              <div class="row">
                <div class="col-lg-4 col-xxl-3">
                  <div class="card">
                    <div class="card-body position-relative">
                      <div class="position-absolute end-0 top-0 p-3">
                      @if ($user->status == 1)
                      <span class="badge bg-success">Active</span>
                            @elseif ($user->status == 0)
                                <span class="badge bg-warning text-dark">Pending</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif</td>
                      </div>
                      <div class="text-center mt-3">
                        <div class="chat-avtar d-inline-flex mx-auto">
                          <img class="rounded-circle img-fluid wid-70" src="https://ambassador.vicomma.com{{$user->image}}" alt="User image">
                        </div>
                        <h5 class="mb-0">{{$user->name}}</h5>
                        <p class="text-muted text-sm">Ambassador</p>
                        <hr class="my-3 border border-secondary-subtle">
                        <div class="row g-3">
                          <div class="col-12">
                            <h5 class="mb-0">NGN{{number_format($user->wallet, 2)}}</h5>
                            <small class="text-muted">Wallet Balance</small>
                          </div>
                          <!-- <div class="col-4 border border-top-0 border-bottom-0">
                            <h5 class="mb-0">40</h5>
                            <small class="text-muted">Project</small>
                          </div>
                          <div class="col-4">
                            <h5 class="mb-0">4.5K</h5>
                            <small class="text-muted">Members</small>
                          </div> -->
                        </div>
                        <hr class="my-3 border border-secondary-subtle">
                        <div class="d-inline-flex align-items-center justify-content-start w-100 mb-3">
                          <i class="ti ti-mail me-2"></i>
                          <p class="mb-0">{{$user->email}}</p>
                        </div>
                        <div class="d-inline-flex align-items-center justify-content-start w-100 mb-3">
                          <i class="ti ti-phone me-2"></i>
                          <p class="mb-0">{{$user->phone_number}}</p>
                        </div>
                        <div class="d-inline-flex align-items-center justify-content-start w-100 mb-3">
                          <i class="ti ti-map-pin me-2"></i>
                          <p class="mb-0">{{$user->street_address}}</p>
                        </div>
                        <div class="d-inline-flex align-items-center justify-content-start w-100">
                          <i class="ti ti-link me-2"></i>
                          <select class="form-control" onchange="change(event)" id="stat">
                          <option value="0" @if($user->status == 0) selected @endif>Pending</option>
                          <option value="1" @if($user->status == 1) selected @endif>Approved</option>
                          <option value="2" @if($user->status > 1) selected @endif>Rejected</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-8 col-xxl-9">
                  <div class="card">
                    <div class="card-header">
                      <h5>Personal Details</h5>
                    </div>
                    <div class="card-body">
                      <ul class="list-group list-group-flush">
                        <li class="list-group-item px-0 pt-0">
                          <div class="row">
                            <div class="col-md-6">
                              <p class="mb-1 text-muted">Full Name</p>
                              <p class="mb-0">{{$user->name}}</p>
                            </div>
                            <div class="col-md-6">
                              <p class="mb-1 text-muted">Email Verification</p>
                              <p class="mb-0">Verified</p>
                            </div>
                          </div>
                        </li>
                        <li class="list-group-item px-0">
                          <div class="row">
                            <div class="col-md-6">
                              <p class="mb-1 text-muted">Phone</p>
                              <p class="mb-0">{{$user->phone_number}}</p>
                            </div>
                            <div class="col-md-6">
                              <p class="mb-1 text-muted">Country</p>
                              <p class="mb-0">Nigeria</p>
                            </div>
                          </div>
                        </li>
                        <li class="list-group-item px-0">
                          <div class="row">
                            <div class="col-md-6">
                              <p class="mb-1 text-muted">Email</p>
                              <p class="mb-0">{{$user->email}}</p>
                            </div>
                            <div class="col-md-6">
                              <p class="mb-1 text-muted">Zip Code</p>
                              <p class="mb-0">{{$user->postal_code}}</p>
                            </div>
                          </div>
                        </li>
                        <li class="list-group-item px-0 pb-0">
                        <div class="row">
                            <div class="col-md-6">
                            <p class="mb-1 text-muted">Address</p>
                          <p class="mb-0">{{$user->street_address}}, {{$user->city}}</p>
                            </div>
                            <div class="col-md-6">
                              <p class="mb-1 text-muted">School/Entity</p>
                              <p class="mb-0">{{strtoupper($user->center)}}</p>
                            </div>
                          </div>
                         
                        </li>
                        <li class="list-group-item px-0 pb-0">
                        <div class="row">
                            <div class="col-md-6">
                            <p class="mb-1 text-muted">AUC</p>
                          <p class="mb-0">{{$user->ref_code}}</p>
                            </div>
                        
                          </div>
                         
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="profile-2" role="tabpanel" aria-labelledby="profile-tab-2">
              <div class="row">
              <div class="col-lg-12 col-12 card py-3 px-3">
            <h3>Transactions</h3>
        <table id="trans-table" class="table table-striped">
            <thead>
                <tr>
                    <th>Amount</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Update Status</th>
                    <th>Account Number</th>
                    <th>Account Name</th>
                    <th>Bank Name</th>
                    <th>Date</th>
                </tr>
            </thead>
                    <tbody>
                        @foreach(DB::table("ambassador_transactions")->where("user_id", $user->id)->orderBy("id", "DESC")->get() as $userr)
                        <tr>
                         <td class="text- f-w-600">NGN{{number_format($userr->amount), 2}}</td>
                        <td class="f-w-600">{{$userr->type}}</td>    
                      
                        <td>
                            @if($userr->status == 'pending')<span class="badge bg-warning">Pending</span>@endif
                            @if($userr->status == 'approved')<span class="badge bg-success">Successful</span>@endif
                             @if($userr->status == 'rejected')<span class="badge bg-danger">Declined</span>@endif
                        </td>
                        <td>
                        <select class="form-control" onchange="change2({{$userr->id}})" id="stat2">
                          <option value="pending" @if($userr->status == 'pending') selected @endif>Pending</option>
                          <option value="approved" @if($userr->status == 'approved') selected @endif>Approved</option>
                          <option value="rejected" @if($userr->status == 'rejected') selected @endif>Rejected</option>
                          </select>
                        </td>
                        <td>{{$user->account_no}}</td>
                        <td>{{$user->account_name}}</td>
                        <td>{{$user->bank}}</td>
                        <td>{{$userr->created_at}}</td></tr>
                            @endforeach()
            </tbody>
        </table>
        </div>
              </div>
            </div>
            <div class="tab-pane" id="profile-3" role="tabpanel" aria-labelledby="profile-tab-3">
              <div class="row">
                <div class="col-12">
                <div class="table-responsive">
                      <table class="table table-hover dataTable-table" id="tb">
                    <thead> 
                      <tr>
                    <th style="width: 51.0428%;">User</th>
                      <th style="width: 11.5258%;">Status</th>
                      <th class="text-end" style="width: 8.78156%;">Earning</th>
                        <th >User Type</th>
                        <th style="width: 11.5258%;">IG Handle</th>
                        <th style="width: 11.5258%;">Business website</th>
                        <th style="width: 11.5258%;">Facebook Handle</th>
                        <th style="width: 11.5258%;">Tiktok Handle</th>
                        <th style="width: 11.5258%;">Business Addres</th>
                      <th style="width: 15.258%;">Date Added</th></tr>
                    </thead> 
                    <tbody>
                        @foreach(DB::table("ambassador_users")->leftjoin('users', 'users.email', 'ambassador_users.email')->where("ambassador_users.ambassador_id", $user->id)->select('ambassador_users.*', 'users.ref_earned')->orderBy("id", "DESC")->get() as $user)
                        <tr>
                            
                            <td>
                          <div class="row align-items-center">
                            <div class="col-auto pe-0">
                              <img src="https://ambassador.vicomma.com/assets/images/user/avatar-2.jpg" alt="user-image" class="wid-55 hei-55 rounded">
                            </div>
                            <div class="col"> 
                              <h6 class="mb-2"><span class="text-truncate w-100">{{$user->name}}</span></h6>
                              <p class="text-muted f-12 mb-0"><span class="text-truncate w-100">{{$user->email}} </span></p>
                            </div>
                          </div>
                        </td> 
                        <td>
                            @if($user->ref_earned == 1)<span class="badge bg-success">Earned</span>@endif
                            @if($user->ref_earned !== 1)<span class="badge bg-warning">Pending</span>@endif
                        </td>
                        <td class="text-end f-w-600">NGN450.00</td>
                        <td class="f-w-600">{{$user->user_type}}</td>
                        <td class="f-w-600">{{$user->ig}}</td>
                        <td class="f-w-600">{{$user->website}}</td>
                        <td class="f-w-600">{{$user->facebook}}</td>
                        <td class="f-w-600">{{$user->tiktok}}</td>
                        <td class="f-w-600">{{$user->address}}</td>
                        <td>{{$user->created_at}}</td></tr>
                            @endforeach()
                           </tbody>
                  </table>
                  
                </div>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="profile-4" role="tabpanel" aria-labelledby="profile-tab-4">
              <div class="card">
                <div class="card-header">
                  <h5>Change Password</h5>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label class="form-label">Old Password</label>
                        <input type="password" class="form-control">
                      </div>
                      <div class="form-group">
                        <label class="form-label">New Password</label>
                        <input type="password" class="form-control">
                      </div>
                      <div class="form-group">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" class="form-control">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <h5>New password must contain:</h5>
                      <ul class="list-group list-group-flush">
                        <li class="list-group-item"><i class="ti ti-circle-check text-success f-16 me-2"></i> At least 8
                          characters</li>
                        <li class="list-group-item"><i class="ti ti-circle-check text-success f-16 me-2"></i> At least 1
                          lower letter (a-z)</li>
                        <li class="list-group-item"><i class="ti ti-circle-check text-success f-16 me-2"></i> At least 1
                          uppercase letter(A-Z)</li>
                        <li class="list-group-item"><i class="ti ti-circle-check text-success f-16 me-2"></i> At least 1
                          number (0-9)</li>
                        <li class="list-group-item"><i class="ti ti-circle-check text-success f-16 me-2"></i> At least 1
                          special characters</li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="card-footer text-end btn-page">
                  <div class="btn btn-outline-secondary">Cancel</div>
                  <div class="btn btn-primary">Update Profile</div>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="profile-5" role="tabpanel" aria-labelledby="profile-tab-5">
              <div class="card">
                <div class="card-header">
                  <h5>Invite Team Members</h5>
                </div>
                <div class="card-body">
                  <h4>5/10 <small>members available in your plan.</small></h4>
                  <hr class="my-3">
                  <div class="row">
                    <div class="col-md-8">
                      <div class="form-group">
                        <label class="form-label">Email Address</label>
                        <div class="row">
                          <div class="col">
                            <input type="email" class="form-control">
                          </div>
                          <div class="col-auto">
                            <button class="btn btn-primary">Send</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body table-card">
                  <div class="table-responsive">
                    <table class="table mb-0">
                      <thead>
                        <tr>
                          <th>MEMBER</th>
                          <th>ROLE</th>
                          <th class="text-end">STATUS</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            <div class="row">
                              <div class="col-auto pe-0">
                                <img src="../assets/images/user/avatar-1.jpg" alt="user-image" class="wid-40 rounded-circle">
                              </div>
                              <div class="col">
                                <h5 class="mb-0">Addie Bass</h5>
                                <p class="text-muted f-12 mb-0">mareva@gmail.com</p>
                              </div>
                            </div>
                          </td>
                          <td><span class="badge bg-primary">Owner</span></td>
                          <td class="text-end"><span class="badge bg-success">Joined</span></td>
                          <td class="text-end"><a href="#" class="avtar avtar-s btn-link-secondary"><i class="ti ti-dots f-18"></i></a></td>
                        </tr>
                        <tr>
                          <td>
                            <div class="row">
                              <div class="col-auto pe-0">
                                <img src="../assets/images/user/avatar-4.jpg" alt="user-image" class="wid-40 rounded-circle">
                              </div>
                              <div class="col">
                                <h5 class="mb-0">Agnes McGee</h5>
                                <p class="text-muted f-12 mb-0">heba@gmail.com</p>
                              </div>
                            </div>
                          </td>
                          <td><span class="badge bg-light-info">Manager</span></td>
                          <td class="text-end"><a href="#" class="btn btn-link-danger">Resend</a> <span class="badge bg-light-success">Invited</span></td>
                          <td class="text-end"><a href="#" class="avtar avtar-s btn-link-secondary"><i class="ti ti-dots f-18"></i></a></td>
                        </tr>
                        <tr>
                          <td>
                            <div class="row">
                              <div class="col-auto pe-0">
                                <img src="../assets/images/user/avatar-5.jpg" alt="user-image" class="wid-40 rounded-circle">
                              </div>
                              <div class="col">
                                <h5 class="mb-0">Agnes McGee</h5>
                                <p class="text-muted f-12 mb-0">heba@gmail.com</p>
                              </div>
                            </div>
                          </td>
                          <td><span class="badge bg-light-warning">Staff</span></td>
                          <td class="text-end"><span class="badge bg-success">Joined</span></td>
                          <td class="text-end"><a href="#" class="avtar avtar-s btn-link-secondary"><i class="ti ti-dots f-18"></i></a></td>
                        </tr>
                        <tr>
                          <td>
                            <div class="row">
                              <div class="col-auto pe-0">
                                <img src="../assets/images/user/avatar-1.jpg" alt="user-image" class="wid-40 rounded-circle">
                              </div>
                              <div class="col">
                                <h5 class="mb-0">Addie Bass</h5>
                                <p class="text-muted f-12 mb-0">mareva@gmail.com</p>
                              </div>
                            </div>
                          </td>
                          <td><span class="badge bg-primary">Owner</span></td>
                          <td class="text-end"><span class="badge bg-success">Joined</span></td>
                          <td class="text-end"><a href="#" class="avtar avtar-s btn-link-secondary"><i class="ti ti-dots f-18"></i></a></td>
                        </tr>
                        <tr>
                          <td>
                            <div class="row">
                              <div class="col-auto pe-0">
                                <img src="../assets/images/user/avatar-4.jpg" alt="user-image" class="wid-40 rounded-circle">
                              </div>
                              <div class="col">
                                <h5 class="mb-0">Agnes McGee</h5>
                                <p class="text-muted f-12 mb-0">heba@gmail.com</p>
                              </div>
                            </div>
                          </td>
                          <td><span class="badge bg-light-info">Manager</span></td>
                          <td class="text-end"><a href="#" class="btn btn-link-danger">Resend</a> <span class="badge bg-light-success">Invited</span></td>
                          <td class="text-end"><a href="#" class="avtar avtar-s btn-link-secondary"><i class="ti ti-dots f-18"></i></a></td>
                        </tr>
                        <tr>
                          <td>
                            <div class="row">
                              <div class="col-auto pe-0">
                                <img src="../assets/images/user/avatar-5.jpg" alt="user-image" class="wid-40 rounded-circle">
                              </div>
                              <div class="col">
                                <h5 class="mb-0">Agnes McGee</h5>
                                <p class="text-muted f-12 mb-0">heba@gmail.com</p>
                              </div>
                            </div>
                          </td>
                          <td><span class="badge bg-light-warning">Staff</span></td>
                          <td class="text-end"><span class="badge bg-success">Joined</span></td>
                          <td class="text-end"><a href="#" class="avtar avtar-s btn-link-secondary"><i class="ti ti-dots f-18"></i></a></td>
                        </tr>
                        <tr>
                          <td>
                            <div class="row">
                              <div class="col-auto pe-0">
                                <img src="../assets/images/user/avatar-1.jpg" alt="user-image" class="wid-40 rounded-circle">
                              </div>
                              <div class="col">
                                <h5 class="mb-0">Addie Bass</h5>
                                <p class="text-muted f-12 mb-0">mareva@gmail.com</p>
                              </div>
                            </div>
                          </td>
                          <td><span class="badge bg-primary">Owner</span></td>
                          <td class="text-end"><span class="badge bg-success">Joined</span></td>
                          <td class="text-end"><a href="#" class="avtar avtar-s btn-link-secondary"><i class="ti ti-dots f-18"></i></a></td>
                        </tr>
                        <tr>
                          <td>
                            <div class="row">
                              <div class="col-auto pe-0">
                                <img src="../assets/images/user/avatar-4.jpg" alt="user-image" class="wid-40 rounded-circle">
                              </div>
                              <div class="col">
                                <h5 class="mb-0">Agnes McGee</h5>
                                <p class="text-muted f-12 mb-0">heba@gmail.com</p>
                              </div>
                            </div>
                          </td>
                          <td><span class="badge bg-light-info">Manager</span></td>
                          <td class="text-end"><a href="#" class="btn btn-link-danger">Resend</a> <span class="badge bg-light-success">Invited</span></td>
                          <td class="text-end"><a href="#" class="avtar avtar-s btn-link-secondary"><i class="ti ti-dots f-18"></i></a></td>
                        </tr>
                        <tr>
                          <td>
                            <div class="row">
                              <div class="col-auto pe-0">
                                <img src="../assets/images/user/avatar-5.jpg" alt="user-image" class="wid-40 rounded-circle">
                              </div>
                              <div class="col">
                                <h5 class="mb-0">Agnes McGee</h5>
                                <p class="text-muted f-12 mb-0">heba@gmail.com</p>
                              </div>
                            </div>
                          </td>
                          <td><span class="badge bg-light-warning">Staff</span></td>
                          <td class="text-end"><span class="badge bg-success">Joined</span></td>
                          <td class="text-end"><a href="#" class="avtar avtar-s btn-link-secondary"><i class="ti ti-dots f-18"></i></a></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="card-footer text-end btn-page">
                  <div class="btn btn-link-danger">Cancel</div>
                  <div class="btn btn-primary">Update Profile</div>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="profile-6" role="tabpanel" aria-labelledby="profile-tab-6">
              <div class="row">
                <div class="col-md-6">
                  <div class="card">
                    <div class="card-header">
                      <h5>Email Settings</h5>
                    </div>
                    <div class="card-body">
                      <h6 class="mb-4">Setup Email Notification</h6>
                      <div class="d-flex align-items-center justify-content-between mb-1">
                        <div>
                          <p class="text-muted mb-0">Email Notification</p>
                        </div>
                        <div class="form-check form-switch p-0">
                          <input class="m-0 form-check-input h5 position-relative" type="checkbox" role="switch" checked="">
                        </div>
                      </div>
                      <div class="d-flex align-items-center justify-content-between mb-1">
                        <div>
                          <p class="text-muted mb-0">Send Copy To Personal Email</p>
                        </div>
                        <div class="form-check form-switch p-0">
                          <input class="m-0 form-check-input h5 position-relative" type="checkbox" role="switch">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header">
                      <h5>Updates from System Notification</h5>
                    </div>
                    <div class="card-body">
                      <h6 class="mb-4">Email you with?</h6>
                      <div class="d-flex align-items-center justify-content-between mb-1">
                        <div>
                          <p class="text-muted mb-0">News about PCT-themes products and feature updates</p>
                        </div>
                        <div class="form-check p-0">
                          <input class="m-0 form-check-input h5 position-relative" type="checkbox" role="switch" checked="">
                        </div>
                      </div>
                      <div class="d-flex align-items-center justify-content-between mb-1">
                        <div>
                          <p class="text-muted mb-0">Tips on getting more out of PCT-themes</p>
                        </div>
                        <div class="form-check p-0">
                          <input class="m-0 form-check-input h5 position-relative" type="checkbox" role="switch" checked="">
                        </div>
                      </div>
                      <div class="d-flex align-items-center justify-content-between mb-1">
                        <div>
                          <p class="text-muted mb-0">Things you missed since you last logged into PCT-themes</p>
                        </div>
                        <div class="form-check  p-0">
                          <input class="m-0 form-check-input h5 position-relative" type="checkbox" role="switch">
                        </div>
                      </div>
                      <div class="d-flex align-items-center justify-content-between mb-1">
                        <div>
                          <p class="text-muted mb-0">News about products and other services</p>
                        </div>
                        <div class="form-check p-0">
                          <input class="m-0 form-check-input h5 position-relative" type="checkbox" role="switch">
                        </div>
                      </div>
                      <div class="d-flex align-items-center justify-content-between mb-1">
                        <div>
                          <p class="text-muted mb-0">Tips and Document business products</p>
                        </div>
                        <div class="form-check p-0">
                          <input class="m-0 form-check-input h5 position-relative" type="checkbox" role="switch">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card">
                    <div class="card-header">
                      <h5>Activity Related Emails</h5>
                    </div>
                    <div class="card-body">
                      <h6 class="mb-4">When to email?</h6>
                      <div class="d-flex align-items-center justify-content-between mb-1">
                        <div>
                          <p class="text-muted mb-0">Have new notifications</p>
                        </div>
                        <div class="form-check form-switch p-0">
                          <input class="m-0 form-check-input h5 position-relative" type="checkbox" role="switch" checked="">
                        </div>
                      </div>
                      <div class="d-flex align-items-center justify-content-between mb-1">
                        <div>
                          <p class="text-muted mb-0">You're sent a direct message</p>
                        </div>
                        <div class="form-check form-switch p-0">
                          <input class="m-0 form-check-input h5 position-relative" type="checkbox" role="switch">
                        </div>
                      </div>
                      <div class="d-flex align-items-center justify-content-between mb-1">
                        <div>
                          <p class="text-muted mb-0">Someone adds you as a connection</p>
                        </div>
                        <div class="form-check form-switch p-0">
                          <input class="m-0 form-check-input h5 position-relative" type="checkbox" role="switch" checked="">
                        </div>
                      </div>
                      <hr class="my-4 border border-secondary-subtle">
                      <h6 class="mb-4">When to escalate emails?</h6>
                      <div class="d-flex align-items-center justify-content-between mb-1">
                        <div>
                          <p class="text-muted mb-0">Upon new order</p>
                        </div>
                        <div class="form-check form-switch p-0">
                          <input class="m-0 form-check-input h5 position-relative" type="checkbox" role="switch" checked="">
                        </div>
                      </div>
                      <div class="d-flex align-items-center justify-content-between mb-1">
                        <div>
                          <p class="text-muted mb-0">New membership approval</p>
                        </div>
                        <div class="form-check form-switch p-0">
                          <input class="m-0 form-check-input h5 position-relative" type="checkbox" role="switch">
                        </div>
                      </div>
                      <div class="d-flex align-items-center justify-content-between mb-1">
                        <div>
                          <p class="text-muted mb-0">Member registration</p>
                        </div>
                        <div class="form-check form-switch p-0">
                          <input class="m-0 form-check-input h5 position-relative" type="checkbox" role="switch" checked="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12 text-end btn-page">
                  <div class="btn btn-outline-secondary">Cancel</div>
                  <div class="btn btn-primary">Update Profile</div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- [ sample-page ] end -->
      </div>
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
            $('#trans-table').DataTable();
            $('#tb').DataTable();
        });

        const change = (e) => {
          	// now for the big event
	$.ajax({
	  // the server script you want to send your data to
		'url': '/admin/change-status',
		// all of your POST/GET variables
		'data': {
			// 'dataname': $('input').val(), ...
			id: "{{$user->id}}",
			status: $("#stat").val(),
			"_token": "{{ csrf_token() }}"
		},
		// you may change this to GET, if you like...
		'type': 'post',
	 
		'beforeSend': function () {
}
	})
	.done( function (response) {
    Swal.fire("sucess",response.message,"success")
		location.reload()
	})
	.fail( function (code, status) {
    Swal.fire("error", "There was an error with that request","error")
	 
	})
	.always( function (xhr, status) {

	});
        }

        const change2 = (id) => {
          	// now for the big event
	$.ajax({
	  // the server script you want to send your data to
		'url': '/admin/change-status2',
		// all of your POST/GET variables
		'data': {
			// 'dataname': $('input').val(), ...
			id: id,
			status: $("#stat2").val(),
			"_token": "{{ csrf_token() }}"
		},
		// you may change this to GET, if you like...
		'type': 'post',
	 
		'beforeSend': function () {
}
	})
	.done( function (response) {
    Swal.fire("success",response.message,"success")
		location.reload()
	})
	.fail( function (code, status) {
    Swal.fire("error", "There was an error with that request","error")
	 
	})
	.always( function (xhr, status) {

	});
        }
    </script>
@endpush
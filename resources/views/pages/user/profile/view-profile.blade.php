@extends('pages.app')
<link rel="stylesheet" href="{{asset('/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('/css/select2-bootstrap.min.css')}}">
@php
$user = Auth::user();
@endphp
@push('scripts')
<script>
     document.title = "Profile";
</script>
@endpush
<style>
    .inputfile {
        width: 0.1px;
        height: 0.1px;
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: -1;
        margin-top: -3.5rem;
    }

    .inputfile+label {
        border-radius: 5px;
        padding: .4rem;
        width: 100%;
        text-align: center;
    }

    /* .inputfile:focus + label,
    .inputfile + label:hover {
        background-color:#f1efef69;
    } */
    .inputfile+label {
        cursor: pointer;
        /* "hand" cursor */
    }

    .preview {
        overflow: hidden;
        width: 160px;
        height: 160px;
        margin: 10px;
        border: 1px solid red;
    }

    .modal-lg {
        max-width: 1000px !important;
    }

    .swal-text {
        text-align: center !important;
    }

    .swal-footer {
        display: flex !important;
        justify-content: center !important;
    }


.port img {
  max-width: 100%;
  display: block;
}

.port .card-list {
  width: 90%;
  max-width: 400px;
}

.port .card {
  background-color: #FFF;
  box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.05), 0 20px 50px 0 rgba(0, 0, 0, 0.1);
  border-radius: 15px;
  overflow: hidden;
  padding: 1.25rem;
  position: relative;
  transition: 0.15s ease-in;
}
.port card:hover, .card:focus-within {
  box-shadow: 0 0 0 2px #16C79A, 0 10px 60px 0 rgba(0, 0, 0, 0.1);
  transform: translatey(-5px);
}

.port .card-image {
  border-radius: 10px;
  overflow: hidden;
}

.port .card-header {
  margin-top: 1.5rem;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.port .card-header a {
  font-weight: 600;
  font-size: 1.375rem;
  line-height: 1.25;
  padding-right: 1rem;
  text-decoration: none;
  color: inherit;
  will-change: transform;
}
/* .port .card-header a:after {
  content: "";
  position: absolute;
  left: 0;
  top: 0;
  right: 0;
  bottom: 0;
} */

.port .icon-button {
  border: 0;
  background-color: #fff;
  border-radius: 50%;
  width: 2.5rem;
  height: 2.5rem;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-shrink: 0;
  font-size: 1.25rem;
  transition: 0.25s ease;
  box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.05), 0 3px 8px 0 rgba(0, 0, 0, 0.15);
  z-index: 1;
  cursor: pointer;
  color: #565656;
}
.port .icon-button svg {
  width: 1em;
  height: 1em;
}
.port .icon-button:hover, .icon-button:focus {
  background-color: #703b97;
  color: #FFF;
}

.port .card-body::after, .card-footer::after, .card-header::after {
    display: none;
    clear: both;
    content: none;
}
.port .card-footer {
  margin-top: 1.25rem;
  border-top: 1px solid #ddd;
  padding-top: 1.25rem;
  display: flex;
  align-items: center;
  flex-wrap: wrap;
}

.port .card-meta {
  display: flex;
  align-items: center;
  color: #787878;
}
.port .card-meta:first-child:after {
  display: block;
  content: "";
  width: 4px;
  height: 4px;
  border-radius: 50%;
  background-color: currentcolor;
  margin-left: 0.75rem;
  margin-right: 0.75rem;
}
.port .card-meta svg {
  flex-shrink: 0;
  width: 1em;
  height: 1em;
  margin-right: 0.25em;
}
.video-component {
  position: relative;
}

.thumbnail {
  position: relative;
  display: inline-block;
  width: 100%;
  height: 200px;
}

.thumbnail img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.play-button {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 80px;
  height: 80px;
  background-color: rgba(0, 0, 0, 0.5);
  border: none;
  border-radius: 50%;
  color: #fff;
  font-size: 40px;
  cursor: pointer;
}

.play-button::before {
  content: '\f04b';
  font-family: 'Font Awesome 5 Free';
  font-weight: 900;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}

video {
  display: none;
  width: 100%;
}

</style>
@section('content')
@include('includes.messages')
@include('includes.uploadPortfolio')
<div class="row">
    <div class="col-sm-12 col-md-8 col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-4">
                        <div>
                            <div class="pRIMGCONT shadow">
                                {{-- @php
                                $path = public_path('img/profile/') . $user->image;
                                @endphp
                                @if (file_exists($path))
                                <img src="{{asset('/img/profile/'. $user->image)}}" class="img-fluid w-100 img"
                                    alt="{{$user->last_name}}">
                                @else --}}
                                <img src="{{$user->image}}" class="img-fluid w-100 img" alt="{{$user->last_name}}">
                                {{-- @endif --}}
                                <div class="w-100 text-white text-center p-1 text-xl cHPROIX">
                                    <input type="file" name="image" id="file" class="inputfile image" accept="image/png, image/gif, image/jpeg, image/jpg">
                                    <label class="d-flex justify-content-center fs-2" for="file"> <i
                                            class="fas fa-camera text-snd" aria-hidden="true"></i></label>
                                </div>
                                {{-- <img src="{{Auth::user()->image}}" class="img-fluid" alt=""> --}}
                            </div>
                            <div class="mt-4">
                                <h6 class="mb-1 font-weight-normal">
                                    <span class="mr-2">
                                        <svg width="14" height="17" viewBox="0 0 14 17" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M6.54019 16.2703L6.41181 16.1338C6.10798 15.8105 4.61258 14.1963 3.19621 12.2457C2.48776 11.27 1.80702 10.221 1.30531 9.215C0.798209 8.19822 0.5 7.27601 0.5 6.54024C0.5 3.21011 3.21011 0.5 6.54019 0.5C9.87062 0.5 12.5807 3.21012 12.5804 6.5402V6.54024C12.5804 7.27602 12.2822 8.19826 11.7751 9.21509C11.2734 10.2211 10.5927 11.2702 9.88425 12.2459C8.46787 14.1966 6.97245 15.8108 6.66876 16.1336L6.54019 16.2703ZM3.33389 6.54047C3.33389 8.30879 4.77187 9.74677 6.54019 9.74677C8.30888 9.74677 9.74649 8.30881 9.74649 6.54047C9.74649 4.77219 8.30888 3.33417 6.54019 3.33417C4.77187 3.33417 3.33389 4.7721 3.33389 6.54047Z"
                                                stroke="#6F3C96" />
                                        </svg>
                                    </span>
                                    @php
                                    $country = \App\Models\Country::find(Auth::user()->country_id);
                                    @endphp
                                    @if ($country != NULL)
                                    {{$country->name}}
                                    @php
                                    $country = $country->name
                                    @endphp
                                    @else
                                    <a href="{{route('user.profile').'#v-pills-profile'}}" class="text-snd"> <i
                                            class="fa fa-plus" aria-hidden="true"></i> Add Country</a>
                                    @endif
                                </h6>
                                <h6 class="mb-1 font-weight-normal mt-2">
                                    <span class="mr-2">
                                        <svg width="14" height="16" viewBox="0 0 14 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M0.151766 15.85C0.233668 12.3752 3.15369 9.56943 6.73706 9.56943C10.3196 9.56943 13.2396 12.3751 13.3215 15.85H11.9998C11.9178 13.0972 9.58488 10.8907 6.73625 10.8907C3.88758 10.8907 1.55551 13.098 1.47347 15.85H0.151766Z"
                                                fill="#6F3C96" stroke="white" stroke-width="0.3" />
                                            <path
                                                d="M2.44297 4.44625L2.44297 4.4462C2.44219 2.07778 4.36992 0.15 6.7384 0.15C9.10772 0.15 11.0355 2.077 11.0355 4.44625C11.0355 6.81549 9.10772 8.74249 6.7384 8.74249C4.37078 8.74249 2.44297 6.81394 2.44297 4.44625ZM6.7384 1.47124C5.09755 1.47124 3.7634 2.80539 3.7634 4.44625C3.7634 6.0871 5.09755 7.42125 6.7384 7.42125C8.38004 7.42125 9.71422 6.08713 9.71422 4.44625C9.71422 2.80531 8.37836 1.47124 6.7384 1.47124Z"
                                                fill="#6F3C96" stroke="white" stroke-width="0.3" />
                                        </svg>
                                    </span>
                                    Member since {{\Carbon\Carbon::parse(Auth::user()->created_at)->diffForHumans()}}
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-8">
                        <div class="mt-5 ml-lg-4">
                            <h6>{{Auth::user()->last_name}} {{Auth::user()->first_name}}</h6>
                            @if (Auth::user()->hasRole('Creative'))
                            <div class="reviews mt-3 text-main">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <span class="text-muted">(Reviews)</span>
                            </div>
                            <div class="mt-3">
                                <h6> <span class="mr-3 text-main font-weight-normal">N/A</span> Jobs Done</h6>
                            </div>
                            @endif
                            @if (Auth::user()->hasRole('vendor') || Auth::user()->hasRole('Creative'))
                            <h6 class="mt-4">Description <a href="#" class="text-snd" data-toggle="modal"
                                    data-target="#desModal"><i class="fas fa-pen-alt ml-2" aria-hidden="true"></i></a>
                            </h6>
                            @endif
                            {{-- @if (Auth::user()->hasRole('Creative') || Auth::user()->hasRole('vendor')) --}}
                         
                          
                                    <div class="p-2 mt-2 rounded" style="background: #f3f6f9">
                                        <p class="font-weight-light" style="font-size: .8rem; line-height: inherit;">
                                          @if(Auth::user()->role == "influencer")
                                            {{$user->details->influencer_description}}
                                            @else
                                            {{$user->details->vendor_description}}
                                            @endif
                                        </p>
                                    </div>
                                    @error('description')
                                    <div class="invalid-feedback d-block">
                                        {{$message}}
                                    </div>
                                    @enderror
                       
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if (Auth::user()->hasRole('Creative'))
        <div class="card shadow-sm">
                            <div class="card-header text-main ch-header">My Portfolio <span class="tip" style="margin-bottom: -5px;" data-show="no" data-content="Manage your portfolio"><ion-icon name="videocam" style="margin-bottom: -5px;" size="large"></ion-icon></span></div>
                            <div class="card-body">
                               <div style="display: flex; align-items: center; justify-content: space-between;"> <p class="small mb-0">Your porfolio will give more info to vendors.</p> @if(count($portfolio) < 4)<a href="#" class="btn btn-primary btn-sm"  data-bs-toggle="modal" data-bs-target="#fileUpload">Add to Portfolio</a>@endif</div>
                                <br />

                                @if(count($portfolio) > 0)
                                <div class="row port" style="gap: 10px;flex-wrap: nowrap;">
                                @foreach($portfolio as $item)
                                <article class="card col-md-6">
                                    <figure class="card-image">
                                    <div class="video-component">
                                    <div class="thumbnail">
                                        <img src="{{$item->thumbnail}}" alt="Video Thumbnail">
                                        <button class="play-button"></button>
                                    </div>
                                    <video controls>
                                        <source src="{{$item->file}}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                    </div>
                                                                            <!-- <img src="https://images.unsplash.com/photo-1494253109108-2e30c049369b?crop=entropy&cs=srgb&fm=jpg&ixid=MnwxNDU4OXwwfDF8cmFuZG9tfHx8fHx8fHx8MTYyNDcwMTUwOQ&ixlib=rb-1.2.1&q=85" alt="An orange painted blue, cut in half laying on a blue background" /> -->
                                    </figure>
                                    <div class="card-header px-1">
                                        <a href="#">{{$item->name}}</a>
                                        <button class="icon-button" onclick="window.open('{{$item->link}}')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" display="block" id="Heart">
                                                <path d="M7 3C4.239 3 2 5.216 2 7.95c0 2.207.875 7.445 9.488 12.74a.985.985 0 0 0 1.024 0C21.125 15.395 22 10.157 22 7.95 22 5.216 19.761 3 17 3s-5 3-5 3-2.239-3-5-3z" />
                                            </svg>

                                        </button>
                                    </div>
                                    <div class="card-body px-1">
                                    <p class="smal mt-2 mb-1">{{$item->description}}</p>
                                    </div>
                                    <div class="card-footer">
                                        <div class="card-meta card-meta--views">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" display="block" id="EyeOpen">
                                                <path d="M21.257 10.962c.474.62.474 1.457 0 2.076C19.764 14.987 16.182 19 12 19c-4.182 0-7.764-4.013-9.257-5.962a1.692 1.692 0 0 1 0-2.076C4.236 9.013 7.818 5 12 5c4.182 0 7.764 4.013 9.257 5.962z" />
                                                <circle cx="12" cy="12" r="3" />
                                            </svg>
                                            {{$item->views}}
                                        </div>
                                        <div class="card-meta card-meta--date">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" display="block" id="Calendar">
                                                <rect x="2" y="4" width="20" height="18" rx="4" />
                                                <path d="M8 2v4" />
                                                <path d="M16 2v4" />
                                                <path d="M2 10h20" />
                                            </svg>
                                            {{\Carbon\Carbon::parse($item->created_at)->format('F d, Y')}}
                                        </div>
                                    </div>
                                </article>
                                @endforeach
                                        </div>

                                @else
                                    <center style="margin-bottom: 40px; margin-top: 40px">
                                    <img src="/portf.svg" style="height: 180px;"/>
                                    
                                    <p class="small mt-3">You do not have an item in your portfolio yet.</p>
                                    </center>
                                @endif
                            </div>
                        </div>
        <div class="card mt-4 shadow-sm">
            <div class="card-header border-bottom text-snd">Reviews</div>
            <div class="card-body">
                <div class="d-flex justify-content-center"></div>
                <h6 class="font-weight-normal text-center">No reviews yet</h6>
            </div>
        </div>
        <div class="card mt-4 shadow-sm">
            <div class="card-header border-bottom text-snd">Jobs Done</div>
            <div class="card-body">
                <div class="d-flex justify-content-center"></div>
                <h6 class="font-weight-normal text-center">No Jobs yet </h6>
                <div class="d-flex justify-content-center">
                    <button class="btn btn-secondary mt-4">Add Previous Jobs Done</button>
                </div>
            </div>
        </div>


        
        @endif
        
    </div>
    <div class="col-sm-12 col-md-4">
        <div class="card shadow-sm">
            <div class="card-header border-bottom text-snd">Verifications</div>
            <div class="card-body">
                <ul class="nav">
                    <li class="nav-item d-flex justify-content-between w-100 border-bottom pb-3 mb-3">
                        <div>
                            <i class="fa fa-envelope text-muted mr-2" aria-hidden="true"></i> <span style="font-size: 0.85rem !important;">Email</span>
                        </div>
                        <div>
                            @if ($user->email_verified_at != NULL)
                            <span class="text-success">
                                <i class="fa fa-check-circle" aria-hidden="true"></i> Verified
                            </span>
                            @else
                            <form action="{{route('user.verify.email')}}" class="mb-0" method="POST">
                                @csrf
                                <input type="hidden" name="email" value="{{$user->email}}">
                                <button type="submit" class="btn btn-success btn-sm"> Verify Email</button>
                            </form>
                            @endif
                        </div>
                    </li>
                    <li class="nav-item d-flex justify-content-between w-100 border-bottom pb-3 mb-3">
                        <div>
                            <i class="fa fa-phone text-muted mr-2"    aria-hidden="true"></i> <span style="font-size: 0.85rem !important;">Phone Number</span>
                        </div>
                        <div>
                            @if ($user->isPhoneVerified)
                            <span class="text-success">
                                <i class="fa fa-check-circle" aria-hidden="true"></i> Verified
                            </span>
                            @else
                            <div>
                                <a href="#" style="font-size: 0.8rem !important;" data-toggle="modal" data-target="#phoneNumberModal"
                                    class="btn btn-success btn-sm ">Verify Phone Number</a>
                            </div>
                            @endif
                        </div>
                    </li>
                    <li class="nav-item d-flex justify-content-between w-100 border-bottom pb-3 mb-3">
                        <div>
                            <i class="fa fa-credit-card text-muted mr-2"  aria-hidden="true"></i> <span style="font-size: 0.85rem !important;">Payment Method</span>
                        </div>
                        <div>
                            @if ($user->flutterwaveSubaccount)
                            <span class="text-success">
                                <i class="fa fa-check-circle" aria-hidden="true"></i> Verified
                            </span>
                            @else
                            <button class="btn btn-sm btn-success btn-sm" data-toggle="modal"
                                data-target="#flutterwaveModal" style="font-size: 0.8rem;">Recieve payment</button>
                            @endif
                            {{-- <span class="text-main">
                                <i class="fa fa-check-circle" aria-hidden="true"></i> Verified
                            </span> --}}
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        @if (Auth::user()->hasRole('Creative'))
        <div class="card shadow-sm mt-4">
            <div class="card-header border-bottom text-snd">Skills</div>
            <div class="card-body">
                {{-- <div class="row justify-content-center g-2">
                    @foreach ($i_skills as $s)
                    <div class="col-12 col-sm-6 col-md-4 col-xl-4">
                        <div class="rounded p-2 text-center" style="background: #eee;">
                            {{$s}}
            </div>
        </div>
        @endforeach --}}
        <div class="d-flex d-md-block d-xl-flex d-grid justify-content-center">
            @if ($i_skills !== NULL)
            @foreach ($i_skills as $s)
            <div class="rounded p-2 text-center mr-1 mt-1" style="background: rgba(111, 60, 150, 0.19);">
                {{$s}}
            </div>
            @endforeach
            @endif
        </div>
        {{-- </div> --}}
        <div>
            <div class="d-flex justify-content-center mt-3">
                <svg width="105" height="101" viewBox="0 0 105 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M102.683 85.85H90.0583C91.6204 85.8483 93.1179 85.227 94.2225 84.1225C95.327 83.0179 95.9483 81.5204 95.95 79.9583V78.275C95.9483 76.713 95.327 75.2154 94.2225 74.1109C93.1179 73.0063 91.6204 72.3851 90.0583 72.3833H85.9657L81.3829 51.287C81.1489 48.7773 79.9892 46.4446 78.1295 44.7432C76.2698 43.0418 73.8434 42.0936 71.3228 42.0833H62.2833V40.4C62.2828 40.2026 62.248 40.0068 62.1802 39.8214C63.8075 38.1116 64.9215 35.979 65.3954 33.6667H65.65C66.9888 33.6649 68.2723 33.1323 69.2189 32.1856C70.1656 31.2389 70.6982 29.9555 70.7 28.6167V17.675C70.6949 12.9889 68.8311 8.49614 65.5175 5.18255C62.2039 1.86895 57.7111 0.00512401 53.025 0H51.3417C46.6555 0.00512401 42.1628 1.86895 38.8492 5.18255C35.5356 8.49614 33.6718 12.9889 33.6667 17.675V28.6167C33.6684 29.9555 34.2011 31.2389 35.1477 32.1856C36.0944 33.1323 37.3779 33.6649 38.7167 33.6667H38.9713C39.4451 35.979 40.5592 38.1116 42.1864 39.8214C42.1187 40.0068 42.0838 40.2026 42.0833 40.4V42.0833H33.0438C30.5233 42.0936 28.0969 43.0418 26.2372 44.7432C24.3775 46.4446 23.2177 48.7773 22.9838 51.287L19.1332 69.0167H17.675C17.2034 69.0163 16.7335 69.0735 16.2757 69.1871L11.6066 59.8467C11.4068 59.4471 11.0565 59.1433 10.6327 59.002C10.2088 58.8608 9.74628 58.8936 9.34671 59.0934C8.94714 59.2932 8.6433 59.6435 8.50203 60.0673C8.36076 60.4911 8.39363 60.9537 8.59342 61.3533L13.3657 70.8957C12.3485 71.9842 11.7829 73.4185 11.7833 74.9083V79.9583C11.7851 81.5204 12.4063 83.0179 13.5109 84.1225C14.6154 85.227 16.113 85.8483 17.675 85.85H1.68333C1.23689 85.85 0.808723 86.0273 0.493037 86.343C0.177351 86.6587 0 87.0869 0 87.5333V94.2667C0 94.7131 0.177351 95.1413 0.493037 95.457C0.808723 95.7726 1.23689 95.95 1.68333 95.95H3.36667V99.3167C3.36667 99.7631 3.54402 100.191 3.8597 100.507C4.17539 100.823 4.60355 101 5.05 101H99.3167C99.7631 101 100.191 100.823 100.507 100.507C100.823 100.191 101 99.7631 101 99.3167V95.95H102.683C103.13 95.95 103.558 95.7726 103.874 95.457C104.189 95.1413 104.367 94.7131 104.367 94.2667V87.5333C104.367 87.0869 104.189 86.6587 103.874 86.343C103.558 86.0273 103.13 85.85 102.683 85.85ZM85.0083 75.75H90.0583C90.7278 75.7506 91.3698 76.0168 91.8432 76.4902C92.3166 76.9636 92.5828 77.6055 92.5833 78.275V79.9583C92.5828 80.6278 92.3166 81.2698 91.8432 81.7432C91.3698 82.2166 90.7278 82.4828 90.0583 82.4833H85.0083C84.3388 82.4828 83.6969 82.2166 83.2235 81.7432C82.7501 81.2698 82.4839 80.6278 82.4833 79.9583V78.275C82.4839 77.6055 82.7501 76.9636 83.2235 76.4902C83.6969 76.0168 84.3388 75.7506 85.0083 75.75ZM67.3333 28.6167C67.3327 29.0629 67.1552 29.4907 66.8396 29.8063C66.5241 30.1218 66.0963 30.2994 65.65 30.3V23.5667H67.3333V28.6167ZM38.7167 30.3C38.2704 30.2994 37.8426 30.1218 37.527 29.8063C37.2115 29.4907 37.0339 29.0629 37.0333 28.6167V23.5667H38.7167V30.3ZM37.0333 20.2V17.675C37.0373 13.8814 38.546 10.2443 41.2285 7.56185C43.911 4.87937 47.5481 3.37062 51.3417 3.36667H53.025C56.8186 3.37062 60.4557 4.87937 63.1382 7.56185C65.8206 10.2443 67.3294 13.8814 67.3333 17.675V20.2H65.65V19.3583C65.65 19.0364 65.6374 18.7145 65.6142 18.4009C65.5941 18.1376 65.5122 17.8828 65.3754 17.657C65.2385 17.4311 65.0504 17.2407 64.8263 17.101C64.6022 16.9613 64.3484 16.8763 64.0854 16.8528C63.8224 16.8293 63.5576 16.8681 63.3123 16.9659C55.2912 20.16 40.5473 20.2 40.4 20.2H37.0333ZM42.0833 31.1417V23.5414C45.8919 23.4467 55.3101 22.9985 62.2833 20.8839V31.1417C62.2804 33.5962 61.3041 35.9495 59.5684 37.6851C57.8328 39.4207 55.4796 40.3971 53.025 40.4H51.3417C48.8871 40.3971 46.5339 39.4207 44.7982 37.6851C43.0626 35.9495 42.0862 33.5962 42.0833 31.1417ZM58.9167 42.3022V43.7667C58.9167 46.5505 55.8972 48.8167 52.1833 48.8167C48.4695 48.8167 45.45 46.5505 45.45 43.7667V42.3022C47.2642 43.2659 49.2874 43.7688 51.3417 43.7667H53.025C55.0792 43.7688 57.1025 43.2659 58.9167 42.3022ZM26.2979 51.8951C26.3144 51.8195 26.3256 51.7428 26.3315 51.6657C26.4685 49.9772 27.2342 48.4016 28.4771 47.2506C29.7201 46.0996 31.3498 45.457 33.0438 45.45H42.2874C43.2259 49.288 47.3059 52.1833 52.1833 52.1833C57.0608 52.1833 61.1408 49.288 62.0792 45.45H71.3228C73.0169 45.457 74.6466 46.0996 75.8895 47.2506C77.1325 48.4016 77.8982 49.9772 78.0351 51.6657C78.041 51.7428 78.0523 51.8195 78.0688 51.8951L82.6306 72.8862C81.5862 73.3479 80.6982 74.1029 80.0744 75.0594C79.4507 76.016 79.118 77.133 79.1167 78.275V79.9583C79.1184 81.5204 79.7397 83.0179 80.8442 84.1225C81.9487 85.227 83.4463 85.8483 85.0083 85.85H77.4333V59.7583C77.4316 58.1963 76.8103 56.6987 75.7058 55.5942C74.6013 54.4897 73.1037 53.8684 71.5417 53.8667H32.825C31.263 53.8684 29.7654 54.4897 28.6609 55.5942C27.5563 56.6987 26.9351 58.1963 26.9333 59.7583V85.85H19.3583C20.9204 85.8483 22.4179 85.227 23.5225 84.1225C24.627 83.0179 25.2483 81.5204 25.25 79.9583V74.9083C25.2497 73.8924 24.9866 72.8939 24.4863 72.0097C23.9859 71.1255 23.2654 70.3859 22.3946 69.8625L26.2979 51.8951ZM74.0667 59.7583V85.85H30.3V59.7583C30.3006 59.0888 30.5668 58.4469 31.0402 57.9735C31.5136 57.5001 32.1555 57.2339 32.825 57.2333H71.5417C72.2112 57.2339 72.8531 57.5001 73.3265 57.9735C73.7999 58.4469 74.0661 59.0888 74.0667 59.7583ZM15.15 79.9583V74.9083C15.1506 74.2388 15.4168 73.5969 15.8902 73.1235C16.3636 72.6501 17.0055 72.3839 17.675 72.3833H19.3583C20.0278 72.3839 20.6698 72.6501 21.1432 73.1235C21.6166 73.5969 21.8828 74.2388 21.8833 74.9083V79.9583C21.8828 80.6278 21.6166 81.2698 21.1432 81.7432C20.6698 82.2166 20.0278 82.4828 19.3583 82.4833H17.675C17.0055 82.4828 16.3636 82.2166 15.8902 81.7432C15.4168 81.2698 15.1506 80.6278 15.15 79.9583ZM97.6333 97.6333H6.73333V95.95H97.6333V97.6333ZM101 92.5833H3.36667V89.2167H101V92.5833Z"
                        fill="#6F3C96" />
                    <path
                        d="M52.1826 67.333C50.8508 67.333 49.549 67.7279 48.4417 68.4678C47.3344 69.2076 46.4714 70.2592 45.9618 71.4896C45.4521 72.72 45.3188 74.0738 45.5786 75.3799C45.8384 76.6861 46.4797 77.8859 47.4214 78.8275C48.363 79.7692 49.5628 80.4105 50.8689 80.6703C52.1751 80.9301 53.5289 80.7968 54.7593 80.2871C55.9896 79.7775 57.0413 78.9145 57.7811 77.8072C58.521 76.6999 58.9159 75.3981 58.9159 74.0663C58.9139 72.2812 58.2038 70.5697 56.9415 69.3074C55.6792 68.0451 53.9677 67.335 52.1826 67.333ZM52.1826 77.433C51.5167 77.433 50.8658 77.2356 50.3121 76.8656C49.7585 76.4957 49.327 75.9699 49.0722 75.3547C48.8173 74.7395 48.7507 74.0626 48.8806 73.4095C49.0105 72.7565 49.3311 72.1566 49.802 71.6857C50.2728 71.2149 50.8727 70.8943 51.5258 70.7644C52.1788 70.6345 52.8557 70.7011 53.4709 70.9559C54.0861 71.2108 54.6119 71.6423 54.9818 72.1959C55.3518 72.7496 55.5492 73.4005 55.5492 74.0663C55.5482 74.9589 55.1931 75.8146 54.562 76.4458C53.9308 77.0769 53.0751 77.432 52.1826 77.433Z"
                        fill="#6F3C96" />
                    <path
                        d="M47.1326 28.6167C48.0622 28.6167 48.8159 27.863 48.8159 26.9333C48.8159 26.0037 48.0622 25.25 47.1326 25.25C46.2029 25.25 45.4492 26.0037 45.4492 26.9333C45.4492 27.863 46.2029 28.6167 47.1326 28.6167Z"
                        fill="#6F3C96" />
                    <path
                        d="M57.2341 28.6167C58.1638 28.6167 58.9174 27.863 58.9174 26.9333C58.9174 26.0037 58.1638 25.25 57.2341 25.25C56.3044 25.25 55.5508 26.0037 55.5508 26.9333C55.5508 27.863 56.3044 28.6167 57.2341 28.6167Z"
                        fill="#6F3C96" />
                    <path
                        d="M50.4997 37.0337H53.8664C54.3129 37.0337 54.741 36.8563 55.0567 36.5406C55.3724 36.2249 55.5497 35.7968 55.5497 35.3503C55.5497 34.9039 55.3724 34.4757 55.0567 34.16C54.741 33.8443 54.3129 33.667 53.8664 33.667H50.4997C50.0533 33.667 49.6251 33.8443 49.3094 34.16C48.9938 34.4757 48.8164 34.9039 48.8164 35.3503C48.8164 35.7968 48.9938 36.2249 49.3094 36.5406C49.6251 36.8563 50.0533 37.0337 50.4997 37.0337Z"
                        fill="#6F3C96" />
                </svg>

            </div>
            <div class="mt-2 p-2 border-top d-flex justify-content-center">
                <button class="btn btn-secondary btn-block" data-bs-toggle="modal" data-bs-target="#skillModal">
                    <i class="fa fa-plus" aria-hidden="true"></i> Add
                    Skill</button>
            </div>
        </div>
    </div>
</div>
@endif
@if (Auth::user()->hasRole('vendor'))
<div class="card shadow mt-4">
    <div class="card-header border-bottom text-snd">Hire a Creative</div>
    <div class="card-body">
        <div class="d-flex justify-content-center">
            <a href="{{route('user.vendor.jobs.index')}}" class="btn btn-secondary btn-block">Post a job</a>
        </div>
    </div>
</div>
@endif
</div>
</div>
<div class="modal fade" id="imgModal" tabindex="-1" role="dialog" aria-labelledby="imgModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-vertically-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Set your Profile Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <div class="row">
                        <div class="col-md-8">
                            <img id="image" src="https://avatars0.githubusercontent.com/u/3456749"
                                style="width: 100%; height: auto;">
                        </div>
                        <div class="col-md-4">
                            <div class="preview"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="crop">Save</button>
            </div>
        </div>
    </div>
</div>
<!-- skill Modal -->
<div class="modal fade" id="skillModal" tabindex="-1" aria-labelledby="skillModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Skill</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('user.skill.add')}}" method="POST" id="skill-save">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <span class="text-danger text-center d-none skill-error">Select at least one skill.</span>
                        <label>Select skills</label>
                        <select class="skills" multiple="multiple" name="skills[]" data-placeholder="Select a skill"
                            style="width: 100%;">
                            {{-- <option selected disabled>Select skills</option> --}}
                            {{-- @foreach ($i_skills as $sk) --}}
                            @foreach ($skills as $skill)
                            <option value="{{$skill->skill}}" @if($i_skills !==NULL )
                                {{in_array($skill->skill, $i_skills) ? 'selected="selected"' : ''}} @endif>
                                {{$skill->skill}}</option>
                            @endforeach
                            {{-- @endforeach --}}
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success btn-block" >Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- description modal --}}

<user-description></user-description>

{{-- Add flutterwave subaccount modal --}}
@if ($user->country)
<subaccount></subaccount>
@else
<!-- Modal -->
<div class="modal fade verifyCountryModal" id="flutterwaveModal" tabindex="-1" aria-labelledby="phoneNumberModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="phoneNumberModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6 class="text-center">You need to verify your country first</h6>
                <a class="btn btn-success btn-block mt-3 cls" href="{{route('user.profile')}}">Proceed</a>
            </div>
        </div>
    </div>
</div>
@endif

@if ($user->country)
<update-phone-number v-bind:country={{$user->country->phone_code}}></update-phone-number>
@else
<div class="modal fade verifyCountryModal" id="phoneNumberModal" tabindex="-1" aria-labelledby="phoneNumberModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="phoneNumberModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h6 class="text-center">You need to verify your country first</h6>
                <a class="btn btn-success btn-block mt-3 cls" href="{{route('user.profile')}}">Proceed</a>
            </div>
        </div>
    </div>
</div>
@endif

@push('scripts')
<script src="{{asset('/js/select2.min.js')}}"></script>
<script>
    $(document).ready(function() {
        //Initialize Select2 Elements
        $('.skills').select2({
            theme: 'bootstrap4'
        })

        $("#skill-save").submit(function(e) {
            var skills = $('.skills').find(":selected").val();
            console.log(skills);
            if(skills == undefined) {
                $('.skill-error').removeClass("d-none");
                $('.skill-error').addClass("d-block");
                return false;
            }
            $('.skill-error').removeClass("d-block");
            $('.skill-error').addClass("d-none");
            return true;
        });
    })
</script>
<script>
    var $modal = $('#imgModal');
    var image = document.getElementById('image');
    var img = document.querySelector('.img');
    var cropper;

    $("body").on("change", ".image", function(e){
        var files = e.target.files;
        var filePath = $("#file").val();
        // Allowed file types
        var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

        if (!allowedExtensions.exec(filePath)) {
            swal({
                title: "Error",
                text: 'Please Select a valid Image',
                icon: "error",
            });
            filePath = '';
        }
        else
        {
            var done = function (url) {
                image.src = url;
                img.src = url;
                $modal.modal('show');
            };
            var reader;
            var file;
            var url;
            if (files && files.length > 0) {
                file = files[0];
                if (URL) {
                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    reader = new FileReader();
                    reader.onload = function (e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        }
    });

    $modal.on('shown.bs.modal', function () {
        cropper = new Cropper(image, {
            aspectRatio: 1,
            viewMode: 3,
            preview: '.preview',
            dragMode: 'crop',
            autoCrop: true,
            zoomable: true,
            minContainerWidth: 500,
            minContainerHeight: 500
            // initialAspectRatio: 282,

        });
    }).on('hidden.bs.modal', function () {
        cropper.destroy();
        cropper = null;
        // image.src = `{{asset('/img/p-img.jpg')}}`;
    });

    $("#crop").click(function(){
        canvas = cropper.getCroppedCanvas({
            width: 282,
            height: 282,
        });

        canvas.toBlob(function(blob) {
            url = URL.createObjectURL(blob);
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function(blob) {
                var base64data = reader.result;

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{route('user.upload.image')}}",
                    data: {'_token': $('meta[name="csrf-token"]').attr('content'),'image': base64data},
                    success: function(data){
                        $modal.modal('hide');
                        swal({
                            title: "Successful!!",
                            text: 'Profile image has been updated',
                            icon: "success",
                        });
                        setTimeout(function() {
                        location.reload();
                        }, 1000)
                    }
                });
            }
        });
    })

    //Tabs
    $('a[data-toggle="pill"]').on('show.bs.tab', function(e) {
        localStorage.setItem('activePill', $(e.target).attr('href'));
    });
    var activePill = localStorage.getItem('activePill');
    if(activePill){
        $('#v-pills-tab a[href="' + activePill + '"]').tab('show');
    }
    //Tabs --------
    // jQuery(document).ready(function(){
    //     swal("Good job!", "You clicked the button!", "success");
    // })
    $(document).ready(function() {
  $('.play-button').on('click', function() {
    var thumbnail = $(this).parent('.thumbnail');
    console.log(this, thumbnail)
    var video = thumbnail.siblings('video');

    thumbnail.hide();
    video.show();
    video.get(0).play();
  });
});
</script>
@endpush
@endsection

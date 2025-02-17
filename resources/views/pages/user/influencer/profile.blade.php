@extends('pages.app')
@push('css')
<style>
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
@endpush
@section('content')
@include('includes.messages')

<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-4">
            <div class="userPF">
                <div class="userPFImgContainer d-flex">
                    {{-- @php
                    $path = public_path('img/profile/') . $user->image;
                    @endphp
                    @if (file_exists($path))
                    <img src="{{asset('/img/profile/'. $user->image)}}" class="userPFImg" alt="{{$user->last_name}}" />
                    @else --}}
                    <img src="{{$user->image}}" class="img-fluid userPFImg" alt="{{$user->last_name}}">
                    {{-- @endif --}}
                    {{-- <img src="{{asset('/img/p-img.jpg')}}" class="userPFImg" alt="" /> --}}
                    <div class="userVerified">
                        <span class="fas fa-star"></span>
                    </div>
                </div>
                <h4 class="text-center mt-2">{{$user->last_name}} {{$user->first_name}}</h4>

                <!-- user Rating -->
                <div class="d-flex text-center justify-content-center mt-2">
                    <div class="mr-2">
                        <span class="fas fa-star rStar"></span>
                        <span class="fas fa-star rStar"></span>
                        <span class="fas fa-star rStar"></span>
                        <span class="fas fa-star rStar"></span>
                    </div>
                    <span>4.0</span>
                    <span class="userReviews mt-1 ml-2">(1673 reviews)</span>
                </div>
                <!-- ../ user Rating -->

                <!-- user Contact -->
                <div class=" d-flex gap-2 d-md-flex d-xl-flex justify-content-center mt-4 mb-4">
                    @if (Auth::user()->hasRole('vendor'))
                    <button class="btn btn-primary btn-sm mr-4 d-block d-md-inline-block">Contact Me</button>
                    @endif

                </div>
                <!-- user Contact -->
                <hr class="uPFHR" />

                <!-- User Skills -->
                <div class="userSkillsContainer mt-4">
                    <h6 class="mb-4">Skills</h6>
                    <div class="d-flex userSkills mb-1">
                        <span class="far fa-check-circle"></span>
                        <h6 class="ml-2">Photoshop Editing</h6>
                    </div>
                    <div class="d-flex userSkills mb-1">
                        <span class="far fa-check-circle"></span>
                        <h6 class="ml-2">Logo Design</h6>
                    </div>
                </div>
                <!-- ../ User Skills -->

                <hr class="uPFHR" />
                <div class="userDetailsContainer mt-4">
                    <div class="uDetails d-flex mb-3">
                        <div class="d-flex">
                            <svg width="14" height="17" viewBox="0 0 14 17" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M6.54019 16.2703L6.41181 16.1338C6.10798 15.8105 4.61258 14.1963 3.19621 12.2457C2.48776 11.27 1.80702 10.221 1.30531 9.215C0.798209 8.19822 0.5 7.27601 0.5 6.54024C0.5 3.21011 3.21011 0.5 6.54019 0.5C9.87062 0.5 12.5807 3.21012 12.5804 6.5402V6.54024C12.5804 7.27602 12.2822 8.19826 11.7751 9.21509C11.2734 10.2211 10.5927 11.2702 9.88425 12.2459C8.46787 14.1966 6.97245 15.8108 6.66876 16.1336L6.54019 16.2703ZM3.33389 6.54047C3.33389 8.30879 4.77187 9.74677 6.54019 9.74677C8.30888 9.74677 9.74649 8.30881 9.74649 6.54047C9.74649 4.77219 8.30888 3.33417 6.54019 3.33417C4.77187 3.33417 3.33389 4.7721 3.33389 6.54047Z"
                                    stroke="#6F3C96" />
                            </svg>
                            <h6 class="ml-2">From</h6>
                        </div>
                        <h6 class="ml-auto font-weight-normal">
                            {{-- @if ($user->country_id != NULL)
                            {{$country = App\Models\Country::find($country_id)}}
                            {{$country->name}}
                            @else
                            -
                            @endif --}}
                        </h6>
                    </div>
                    <div class="uDetails d-flex mb-3">
                        <div class="d-flex">
                            <svg width="14" height="16" viewBox="0 0 14 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M0.151766 15.8505C0.233668 12.3756 3.15369 9.56992 6.73706 9.56992C10.3196 9.56992 13.2396 12.3756 13.3215 15.8505H11.9998C11.9178 13.0977 9.58488 10.8912 6.73625 10.8912C3.88758 10.8912 1.55551 13.0985 1.47347 15.8505H0.151766Z"
                                    fill="#6F3C96" stroke="white" stroke-width="0.3" />
                                <path
                                    d="M2.44297 4.44625L2.44297 4.4462C2.44219 2.07778 4.36992 0.15 6.7384 0.15C9.10772 0.15 11.0355 2.077 11.0355 4.44625C11.0355 6.81549 9.10772 8.74249 6.7384 8.74249C4.37078 8.74249 2.44297 6.81394 2.44297 4.44625ZM6.7384 1.47124C5.09755 1.47124 3.7634 2.80539 3.7634 4.44625C3.7634 6.0871 5.09755 7.42125 6.7384 7.42125C8.38004 7.42125 9.71422 6.08713 9.71422 4.44625C9.71422 2.80531 8.37836 1.47124 6.7384 1.47124Z"
                                    fill="#6F3C96" stroke="white" stroke-width="0.3" />
                            </svg>
                            <h6 class="ml-2">Member Since</h6>
                        </div>
                        <h6 class="ml-auto font-weight-normal">
                            {{\Carbon\Carbon::parse(Auth::user()->created_at)->diffForHumans()}}</h6>
                    </div>
                    {{-- <div class="uDetails d-flex mb-3">
                        <div class="d-flex">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7 0C3.14029 0 0 3.14013 0 7C0 10.8599 3.14029 14 7 14C10.8599 14 14 10.8599 14 7C14 3.14013 10.8597 0 7 0ZM7 12.9781C3.70371 12.9781 1.02189 10.2963 1.02189 7C1.02189 3.70371 3.70371 1.02189 7 1.02189C10.2963 1.02189 12.9781 3.70368 12.9781 6.99984C12.9781 10.2963 10.2963 12.9781 7 12.9781Z"
                                    fill="#6F3C96" />
                                <path
                                    d="M9.38443 7.00047H7.17033V3.93477C7.17033 3.65256 6.9416 3.42383 6.65938 3.42383C6.37717 3.42383 6.14844 3.65256 6.14844 3.93477V7.51142C6.14844 7.79363 6.37717 8.02236 6.65938 8.02236H9.38443C9.66665 8.02236 9.89538 7.79363 9.89538 7.51142C9.89538 7.2292 9.66665 7.00047 9.38443 7.00047Z"
                                    fill="#6F3C96" />
                            </svg>
                            <h6 class="ml-2">Avg.Response Time</h6>
                        </div>
                        <h6 class="ml-auto font-weight-bold">6Hrs</h6>
                    </div>
                    <div class="uDetails d-flex mb-3">
                        <div class="d-flex">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M15.9122 0.324736C15.8952 0.187122 15.7868 0.0787406 15.6492 0.0617254C14.4095 -0.0916133 13.1301 0.042049 11.9492 0.448116C10.768 0.854224 9.67689 1.53568 8.79375 2.41882L6.77842 4.43415L3.86934 4.80934C3.80301 4.81788 3.74144 4.84817 3.69415 4.89542L0.889335 7.70023C0.809944 7.77962 0.781074 7.89651 0.814419 8.00376C0.847684 8.11102 0.937719 8.19097 1.04812 8.21142L3.16885 8.60422L3.58556 9.02093L2.69839 9.50135C2.61444 9.54679 2.55687 9.62924 2.54312 9.72371C2.52937 9.81818 2.56102 9.91358 2.62852 9.98108L5.99277 13.3453C6.04991 13.4025 6.127 13.4339 6.20663 13.4339C6.22107 13.4339 6.23566 13.4329 6.25018 13.4308C6.34465 13.417 6.42711 13.3594 6.47255 13.2755L6.95301 12.3883L7.36972 12.805L7.76252 14.9258C7.783 15.0362 7.86292 15.1262 7.97017 15.1595C7.99964 15.1687 8.02984 15.1731 8.05984 15.1731C8.13887 15.1731 8.21612 15.1421 8.27374 15.0845L11.0786 12.2797C11.1258 12.2325 11.1561 12.1708 11.1646 12.1046L11.5399 9.19544L13.5552 7.18006C14.4383 6.29692 15.1198 5.20581 15.5259 4.0247C15.9319 2.84372 16.0655 1.56423 15.9122 0.324736ZM3.21494 7.99776L1.72352 7.72152L4.04893 5.39604L6.07833 5.13432L3.21494 7.99776ZM6.13377 12.6311L3.34283 9.8402L4.03171 9.46716L6.50678 11.9423L6.13377 12.6311ZM10.5779 11.925L8.25245 14.2504L7.97618 12.7591L10.8396 9.89564L10.5779 11.925ZM13.1274 6.7525L7.6499 12.23L3.7439 8.32403L9.22143 2.84646C10.0173 2.05057 10.9956 1.43218 12.0554 1.0526C12.1923 1.75789 12.5372 2.41217 13.0495 2.92444C13.5618 3.43675 14.216 3.78161 14.9213 3.91854C14.5417 4.97828 13.9233 5.95661 13.1274 6.7525ZM15.1034 3.33748C14.4904 3.23293 13.9202 2.9398 13.4771 2.4968C13.0341 2.0538 12.741 1.48355 12.6365 0.870553C13.5131 0.634316 14.4339 0.553756 15.3375 0.636413C15.4202 1.54003 15.3396 2.46087 15.1034 3.33748Z"
                                    fill="#6F3C96" />
                                <path
                                    d="M8.92709 4.45442C8.2118 5.16974 8.2118 6.33359 8.92709 7.04892C9.28477 7.4066 9.7545 7.58538 10.2244 7.58538C10.694 7.58538 11.164 7.40652 11.5216 7.04892H11.5216C12.2369 6.33363 12.2369 5.16974 11.5216 4.45442C10.8063 3.73913 9.64237 3.73917 8.92709 4.45442ZM11.0939 6.62124C10.6144 7.10077 9.83418 7.10069 9.35477 6.62124C8.87524 6.14175 8.87524 5.36155 9.35477 4.88206C9.59447 4.64231 9.90941 4.52248 10.2243 4.52248C10.5393 4.52248 10.8542 4.64235 11.0939 4.88206C11.5734 5.36155 11.5734 6.14175 11.0939 6.62124Z"
                                    fill="#6F3C96" />
                                <path
                                    d="M3.97017 12.0612C3.85203 11.9431 3.66059 11.9431 3.54249 12.0612L0.947949 14.6557C0.82985 14.7738 0.82985 14.9653 0.947949 15.0834C1.00702 15.1424 1.08443 15.172 1.16181 15.172C1.23918 15.172 1.3166 15.1424 1.37567 15.0834L3.97017 12.4889C4.08823 12.3708 4.08823 12.1793 3.97017 12.0612Z"
                                    fill="#6F3C96" />
                                <path
                                    d="M4.36688 12.8894L3.19795 14.0583C3.07985 14.1764 3.07985 14.3679 3.19795 14.4859C3.25702 14.545 3.33443 14.5745 3.41181 14.5745C3.48918 14.5745 3.5666 14.545 3.62567 14.4859L4.7946 13.317C4.9127 13.1989 4.9127 13.0074 4.7946 12.8894C4.67646 12.7713 4.48502 12.7713 4.36688 12.8894Z"
                                    fill="#6F3C96" />
                                <path
                                    d="M2.79035 14.5918C2.66383 14.5918 2.54835 14.6734 2.50561 14.7923C2.46214 14.9132 2.50258 15.052 2.60302 15.1316C2.70572 15.2131 2.85567 15.2175 2.963 15.1423C3.07751 15.0621 3.12396 14.9081 3.06941 14.7785C3.02453 14.6666 2.91035 14.5918 2.79035 14.5918Z"
                                    fill="#6F3C96" />
                                <path d="M3.06846 14.7787C3.07612 14.7969 3.0612 14.7605 3.06846 14.7787V14.7787Z"
                                    fill="#6F3C96" />
                                <path
                                    d="M1.93316 15.3229L1.7722 15.4839C1.65406 15.6019 1.65406 15.7934 1.77216 15.9115C1.83123 15.9706 1.90861 16.0001 1.98602 16.0001C2.0634 16.0001 2.14081 15.9706 2.19984 15.9116L2.3608 15.7506C2.47894 15.6325 2.47894 15.441 2.36084 15.323C2.24274 15.2049 2.05122 15.2048 1.93316 15.3229Z"
                                    fill="#6F3C96" />
                                <path
                                    d="M1.71643 12.6608C1.59829 12.5427 1.40685 12.5427 1.28875 12.6608L0.119824 13.8298C0.00172536 13.9479 0.00172536 14.1393 0.119824 14.2574C0.178893 14.3164 0.256309 14.346 0.333684 14.346C0.411059 14.346 0.488474 14.3165 0.547543 14.2574L1.71647 13.0885C1.83453 12.9704 1.83453 12.7789 1.71643 12.6608Z"
                                    fill="#6F3C96" />
                                <path
                                    d="M2.1989 12.5441C2.3216 12.5133 2.41369 12.4063 2.42647 12.2805C2.43901 12.1574 2.37127 12.0366 2.26132 11.9811C2.14459 11.9221 1.99831 11.9467 1.90775 12.0413C1.81078 12.1426 1.79679 12.3004 1.87339 12.4177C1.87098 12.4141 1.86912 12.4114 1.874 12.4189C1.87908 12.4263 1.87735 12.4236 1.87493 12.4201C1.94617 12.5236 2.07621 12.575 2.1989 12.5441Z"
                                    fill="#6F3C96" />
                                <path
                                    d="M2.98109 11.8237L3.14201 11.6627C3.26011 11.5446 3.26011 11.3531 3.14197 11.2351C3.02375 11.1169 2.83227 11.117 2.71433 11.2351L2.55341 11.3961C2.43531 11.5142 2.43531 11.7056 2.55345 11.8237C2.61252 11.8827 2.6899 11.9123 2.76727 11.9123C2.84465 11.9123 2.92206 11.8827 2.98109 11.8237Z"
                                    fill="#6F3C96" />
                            </svg>
                            <h6 class="ml-2">Recent Delivery</h6>
                        </div>
                        <h6 class="ml-auto font-weight-bold">1 Day</h6>
                    </div> --}}
                    <div class="uDescription mt-5">
                        @if ($user->description)
                        <h6 class="mb-4">Description</h6>
                        <p>
                            {{$user->description}}
                        </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @if($details->video)
        <div class="col-12 col-sm-12 col-md-12 col-lg-8">
        <div class="card shadow-sm">
                            <div class="card-header text-main ch-header">Portfolio Video <span class="tip" style="margin-bottom: -5px;" data-show="no" data-content="Creative portfolio"><ion-icon name="videocam" style="margin-bottom: -5px;" size="large"></ion-icon></span></div>
                            <div class="card-body row port" style="gap: 5px;flex-wrap: nowrap;">

                                <article class="card col-md-5 mx-3">
                                    <figure class="card-image">
                                    <div class="video-component">
                                    <div class="thumbnail">
                                        <img src="/video-pre.png" alt="Video Thumbnail">
                                        <button class="play-button"></button>
                                    </div>
                                    <video controls>
                                        <source src="{{$details->video}}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                    </div>
                                                                            <!-- <img src="https://images.unsplash.com/photo-1494253109108-2e30c049369b?crop=entropy&cs=srgb&fm=jpg&ixid=MnwxNDU4OXwwfDF8cmFuZG9tfHx8fHx8fHx8MTYyNDcwMTUwOQ&ixlib=rb-1.2.1&q=85" alt="An orange painted blue, cut in half laying on a blue background" /> -->
                                    </figure>
                                </article>

                               
                            </div>
                        </div>         
    
        </div>
        @endif
        <div class="col-12 col-sm-12 col-md-12 col-lg-8">
        @if (count($portfolio) > 0)
        <div class="card shadow-sm">
                            <div class="card-header text-main ch-header">Portfolio <span class="tip" style="margin-bottom: -5px;" data-show="no" data-content="Creative portfolio"><ion-icon name="videocam" style="margin-bottom: -5px;" size="large"></ion-icon></span></div>
                            <div class="card-body row port" style="gap: 5px;flex-wrap: nowrap;">

                                @foreach($portfolio as $item)
                                <article class="card col-md-5 mx-3">
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
                        </div>
                        @endif
            <div class="productSuggestionsContainer">
                <div class="owl-carousel owl-theme">
                    <div class="item">
                        <div class="productSuggestions">
                            <div class="productSuggestionsDetailsContainer">
                                <div class="psIP d-flex">
                                    <img src="{{asset('img/pS1.png')}}" alt="" />
                                    <h4 class="ml-auto">$200</h4>
                                </div>
                                <div class="d-flex mt-2">
                                    <p class="mr-4">
                                        I will create a creative logo for your website
                                    </p>
                                    <svg class="ml-auto mt-4" width="22" height="20" viewBox="0 0 22 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M20.4408 2.09464C19.4013 1.07958 17.9651 0.572266 16.1316 0.572266C15.6242 0.572266 15.1063 0.660244 14.5785 0.836114C14.0505 1.01211 13.5593 1.24956 13.1055 1.54828C12.6511 1.84692 12.2605 2.12736 11.9329 2.38919C11.6057 2.6511 11.2946 2.92944 11 3.22399C10.7053 2.92944 10.3943 2.6511 10.067 2.38919C9.73949 2.12736 9.34879 1.84709 8.89445 1.54828C8.4402 1.24943 7.9491 1.01216 7.42123 0.836114C6.8934 0.660287 6.37563 0.572266 5.86823 0.572266C4.03483 0.572266 2.59854 1.07971 1.55914 2.09464C0.519743 3.10948 0 4.51714 0 6.31772C0 6.8661 0.0963203 7.43095 0.288574 8.01184C0.480828 8.59294 0.699914 9.08817 0.945401 9.49732C1.19085 9.90642 1.46919 10.3055 1.78021 10.6943C2.09123 11.0831 2.31853 11.3509 2.46159 11.4984C2.60478 11.6455 2.71735 11.752 2.79918 11.8174L10.4598 19.2081C10.6072 19.3555 10.7872 19.4293 11 19.4293C11.2127 19.4293 11.3929 19.3555 11.5402 19.2084L19.1886 11.8422C21.0629 9.96808 22 8.12652 22 6.31772C22 4.51714 21.4802 3.10948 20.4408 2.09464Z"
                                            fill="#E2E2E2" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="productSuggestions">
                            <div class="productSuggestionsDetailsContainer">
                                <div class="psIP d-flex">
                                    <img src="{{asset('img/pS2.png')}}" alt="" />
                                    <h4 class="ml-auto">$200</h4>
                                </div>
                                <div class="d-flex mt-2">
                                    <p class="mr-4">
                                        I will create a creative logo for your website
                                    </p>
                                    <svg class="ml-auto mt-4" width="22" height="20" viewBox="0 0 22 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M20.4408 2.09464C19.4013 1.07958 17.9651 0.572266 16.1316 0.572266C15.6242 0.572266 15.1063 0.660244 14.5785 0.836114C14.0505 1.01211 13.5593 1.24956 13.1055 1.54828C12.6511 1.84692 12.2605 2.12736 11.9329 2.38919C11.6057 2.6511 11.2946 2.92944 11 3.22399C10.7053 2.92944 10.3943 2.6511 10.067 2.38919C9.73949 2.12736 9.34879 1.84709 8.89445 1.54828C8.4402 1.24943 7.9491 1.01216 7.42123 0.836114C6.8934 0.660287 6.37563 0.572266 5.86823 0.572266C4.03483 0.572266 2.59854 1.07971 1.55914 2.09464C0.519743 3.10948 0 4.51714 0 6.31772C0 6.8661 0.0963203 7.43095 0.288574 8.01184C0.480828 8.59294 0.699914 9.08817 0.945401 9.49732C1.19085 9.90642 1.46919 10.3055 1.78021 10.6943C2.09123 11.0831 2.31853 11.3509 2.46159 11.4984C2.60478 11.6455 2.71735 11.752 2.79918 11.8174L10.4598 19.2081C10.6072 19.3555 10.7872 19.4293 11 19.4293C11.2127 19.4293 11.3929 19.3555 11.5402 19.2084L19.1886 11.8422C21.0629 9.96808 22 8.12652 22 6.31772C22 4.51714 21.4802 3.10948 20.4408 2.09464Z"
                                            fill="#E2E2E2" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="productSuggestions">
                            <div class="productSuggestionsDetailsContainer">
                                <div class="psIP d-flex">
                                    <img src="{{asset('img/pS3.png')}}" alt="" />
                                    <h4 class="ml-auto">$200</h4>
                                </div>
                                <div class="d-flex mt-2">
                                    <p class="mr-4">
                                        I will create a creative logo for your website
                                    </p>
                                    <svg class="ml-auto mt-4" width="22" height="20" viewBox="0 0 22 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M20.4408 2.09464C19.4013 1.07958 17.9651 0.572266 16.1316 0.572266C15.6242 0.572266 15.1063 0.660244 14.5785 0.836114C14.0505 1.01211 13.5593 1.24956 13.1055 1.54828C12.6511 1.84692 12.2605 2.12736 11.9329 2.38919C11.6057 2.6511 11.2946 2.92944 11 3.22399C10.7053 2.92944 10.3943 2.6511 10.067 2.38919C9.73949 2.12736 9.34879 1.84709 8.89445 1.54828C8.4402 1.24943 7.9491 1.01216 7.42123 0.836114C6.8934 0.660287 6.37563 0.572266 5.86823 0.572266C4.03483 0.572266 2.59854 1.07971 1.55914 2.09464C0.519743 3.10948 0 4.51714 0 6.31772C0 6.8661 0.0963203 7.43095 0.288574 8.01184C0.480828 8.59294 0.699914 9.08817 0.945401 9.49732C1.19085 9.90642 1.46919 10.3055 1.78021 10.6943C2.09123 11.0831 2.31853 11.3509 2.46159 11.4984C2.60478 11.6455 2.71735 11.752 2.79918 11.8174L10.4598 19.2081C10.6072 19.3555 10.7872 19.4293 11 19.4293C11.2127 19.4293 11.3929 19.3555 11.5402 19.2084L19.1886 11.8422C21.0629 9.96808 22 8.12652 22 6.31772C22 4.51714 21.4802 3.10948 20.4408 2.09464Z"
                                            fill="#E2E2E2" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="productSuggestions">
                            <div class="productSuggestionsDetailsContainer">
                                <div class="psIP d-flex">
                                    <img src="{{asset('img/pS1.png')}}" alt="" />
                                    <h4 class="ml-auto">$200</h4>
                                </div>
                                <div class="d-flex mt-2">
                                    <p class="mr-4">
                                        I will create a creative logo for your website
                                    </p>
                                    <svg class="ml-auto mt-4" width="22" height="20" viewBox="0 0 22 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M20.4408 2.09464C19.4013 1.07958 17.9651 0.572266 16.1316 0.572266C15.6242 0.572266 15.1063 0.660244 14.5785 0.836114C14.0505 1.01211 13.5593 1.24956 13.1055 1.54828C12.6511 1.84692 12.2605 2.12736 11.9329 2.38919C11.6057 2.6511 11.2946 2.92944 11 3.22399C10.7053 2.92944 10.3943 2.6511 10.067 2.38919C9.73949 2.12736 9.34879 1.84709 8.89445 1.54828C8.4402 1.24943 7.9491 1.01216 7.42123 0.836114C6.8934 0.660287 6.37563 0.572266 5.86823 0.572266C4.03483 0.572266 2.59854 1.07971 1.55914 2.09464C0.519743 3.10948 0 4.51714 0 6.31772C0 6.8661 0.0963203 7.43095 0.288574 8.01184C0.480828 8.59294 0.699914 9.08817 0.945401 9.49732C1.19085 9.90642 1.46919 10.3055 1.78021 10.6943C2.09123 11.0831 2.31853 11.3509 2.46159 11.4984C2.60478 11.6455 2.71735 11.752 2.79918 11.8174L10.4598 19.2081C10.6072 19.3555 10.7872 19.4293 11 19.4293C11.2127 19.4293 11.3929 19.3555 11.5402 19.2084L19.1886 11.8422C21.0629 9.96808 22 8.12652 22 6.31772C22 4.51714 21.4802 3.10948 20.4408 2.09464Z"
                                            fill="#E2E2E2" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="productSuggestions">
                            <div class="productSuggestionsDetailsContainer">
                                <div class="psIP d-flex">
                                    <img src="{{asset('img/pS3.png')}}" alt="" />
                                    <h4 class="ml-auto">$200</h4>
                                </div>
                                <div class="d-flex mt-2">
                                    <p class="mr-4">
                                        I will create a creative logo for your website
                                    </p>
                                    <svg class="ml-auto mt-4" width="22" height="20" viewBox="0 0 22 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M20.4408 2.09464C19.4013 1.07958 17.9651 0.572266 16.1316 0.572266C15.6242 0.572266 15.1063 0.660244 14.5785 0.836114C14.0505 1.01211 13.5593 1.24956 13.1055 1.54828C12.6511 1.84692 12.2605 2.12736 11.9329 2.38919C11.6057 2.6511 11.2946 2.92944 11 3.22399C10.7053 2.92944 10.3943 2.6511 10.067 2.38919C9.73949 2.12736 9.34879 1.84709 8.89445 1.54828C8.4402 1.24943 7.9491 1.01216 7.42123 0.836114C6.8934 0.660287 6.37563 0.572266 5.86823 0.572266C4.03483 0.572266 2.59854 1.07971 1.55914 2.09464C0.519743 3.10948 0 4.51714 0 6.31772C0 6.8661 0.0963203 7.43095 0.288574 8.01184C0.480828 8.59294 0.699914 9.08817 0.945401 9.49732C1.19085 9.90642 1.46919 10.3055 1.78021 10.6943C2.09123 11.0831 2.31853 11.3509 2.46159 11.4984C2.60478 11.6455 2.71735 11.752 2.79918 11.8174L10.4598 19.2081C10.6072 19.3555 10.7872 19.4293 11 19.4293C11.2127 19.4293 11.3929 19.3555 11.5402 19.2084L19.1886 11.8422C21.0629 9.96808 22 8.12652 22 6.31772C22 4.51714 21.4802 3.10948 20.4408 2.09464Z"
                                            fill="#E2E2E2" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="productReviews">
                <div class="productReviewsHeader d-flex">
                    <div class="pRSt d-flex">
                        <h6>Product Reviews</h6>
                        <div class="mr-1 ml-1">
                            <span class="fas fa-star rStar"></span>
                            <span class="fas fa-star rStar"></span>
                            <span class="fas fa-star rStar"></span>
                            <span class="fas fa-star rStar"></span>
                        </div>
                        <h6 class="rvsDay mt-1">5 (1,242)</h6>
                    </div>
                </div>
                <hr />
                <div class="row mt-4">
                    <div class="col-md-4 mb-sm-4">
                        <div class="pRSUBH text-center">
                            <h6>Seller Communication</h6>
                            <div class="mr-2 ml-2">
                                <span class="fas fa-star rStar"></span>
                                <span class="fas fa-star rStar"></span>
                                <span class="fas fa-star rStar"></span>
                                <span class="fas fa-star rStar"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 sm-mb-2">
                        <div class="pRSUBH text-center">
                            <h6>Service as Described</h6>
                            <div class="mr-2 ml-2">
                                <span class="fas fa-star rStar"></span>
                                <span class="fas fa-star rStar"></span>
                                <span class="fas fa-star rStar"></span>
                                <span class="fas fa-star rStar"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 sm-mb-2">
                        <div class="pRSUBH text-center">
                            <h6>Would Recommend</h6>
                            <div class="mr-2 ml-2">
                                <span class="fas fa-star rStar"></span>
                                <span class="fas fa-star rStar"></span>
                                <span class="fas fa-star rStar"></span>
                                <span class="fas fa-star rStar"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="reviewContainer">
                    <div class="d-flex">
                        <div class="urcContainer">
                            <img src="{{asset('img/reviewImg1.png')}}" alt="" />
                        </div>
                        <div class="urDetails mt-2 pl-3">
                            <div class="d-flex">
                                <div class="mr-1">
                                    <span class="fas fa-star rStar"></span>
                                    <span class="fas fa-star rStar"></span>
                                    <span class="fas fa-star rStar"></span>
                                    <span class="fas fa-star rStar"></span>
                                </div>
                                <h6 class="rvsDay mt-1">1 day ago</h6>
                            </div>
                            <p class="mt-2 mb-0">Outstanding service</p>
                            <em>Lorem</em>
                        </div>
                    </div>
                </div>
                <div class="reviewContainer">
                    <div class="d-flex">
                        <div class="urcContainer">
                            <img src="{{asset('img/Vicomma.png')}}" alt="" />
                        </div>
                        <div class="urDetails mt-2 pl-3">
                            <div class="d-flex">
                                <div class="mr-1">
                                    <span class="fas fa-star rStar"></span>
                                    <span class="fas fa-star rStar"></span>
                                    <span class="fas fa-star rStar"></span>
                                    <span class="fas fa-star rStar"></span>
                                </div>
                                <h6 class="rvsDay mt-1">1 day ago</h6>
                            </div>
                            <p class="mt-2 mb-0">Outstanding service</p>
                            <em>Lorem</em>
                        </div>
                    </div>
                </div>
                <div class="reviewContainer">
                    <div class="d-flex">
                        <div class="urcContainer">
                            <img src="{{asset('img/reviewImg3.png')}}" alt="" />
                        </div>
                        <div class="urDetails mt-2 pl-3">
                            <div class="d-flex">
                                <div class="mr-1">
                                    <span class="fas fa-star rStar"></span>
                                    <span class="fas fa-star rStar"></span>
                                    <span class="fas fa-star rStar"></span>
                                    <span class="fas fa-star rStar"></span>
                                </div>
                                <h6 class="rvsDay mt-1">1 day ago</h6>
                            </div>
                            <p class="mt-2 mb-0">Outstanding service</p>
                            <em>Lorem</em>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@push('scripts')
<script type="text/javascript">
    $(document).ready(function () {
                $('.owl-carousel').owlCarousel({
                  loop: true,
                  margin: 10,
                  nav: false,
                  dots: false,
                  center: true,
                  responsive: {
                    0: {
                      items: 1,
                    },
                    600: {
                      items: 2,
                    },
                    1000: {
                      items: 3,
                    },
                  },
                })
              })

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

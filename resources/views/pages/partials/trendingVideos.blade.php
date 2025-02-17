<section class="sectionBg2 vd_su2">
    <div class="p-4">
        <div class="video_suggestions">
            <div class="single_suggestion">
                <div class="title_sec">

                    <h2 class="heading">Trending</h2>

                </div>

                <div class="suggestion_list">
                    <div class="owl-carousel owl-theme suggestion_carousel suggestion_carousel_r4">
                        @if (count($trending_videos) > 0)
                        @foreach ($trending_videos as $vid)

                        <div class="item">

                            <div class="single_video">

                                <div class="embed-responsive embed-responsive-16by9 shadow other-vid">
                                    <video playsinline muted id="vid{{ $vid->id }}"
                                        class="embed-responsive-item gVideo theVideo{{ $vid->id }}"
                                        poster="{{$vid->video_thumb ?? '' }}">
                                        {{-- <data-src src="{{ $vid->file }}" type="video/mp4"></data-src> --}}
                                    </video>
                                    <div class="overlay text-center" onclick="loadVideo('{{ $vid->id }}')">
                                        <img src="{{ asset('images/video_icon.svg') }}" style="left:0!important"
                                            class="icon" height="15">
                                    </div>
                                </div>
                                <div class="row vid-detail pt-2 px-2">
                                    <div class="w-100 video-name">{{ ucfirst($vid->name) }}</div>
                                    <div class="row text-right" style="color:#BDBDBD; font-size: 15px;">
                                        <div class="btn-group dropleft">

                                            <div class="dropdown-menu g-menu">
                                                <a class="dropdown-item" href="/video/{{$vid->id}}">
                                                    <span class="guser-menu-icon"><i class="fa fa-external-link"
                                                            aria-hidden="true"></i> </span>
                                                    Open
                                                </a>
                                                <a class="dropdown-item" href="#">
                                                    <span class="guser-menu-icon"><i class="fa fa-clone"
                                                            aria-hidden="true"></i></span>
                                                    Copy Link
                                                </a>
                                                <a class="dropdown-item" href="#">
                                                    <span class="guser-menu-icon"><i class="fa fa-download"
                                                            aria-hidden="true"></i></span>
                                                    Download
                                                </a>
                                                <a class="dropdown-item" href="#">
                                                    <span class="guser-menu-icon"><i class="fa fa-share"
                                                            aria-hidden="true"></i></span>
                                                    Share
                                                </a>
                                                @if($vid->job && $vid->job->product)
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="/mall/show/{{ $vid->job->product->id}}">
                                                    <span class="guser-menu-icon"><i class="fa fa-shopping-cart"
                                                            aria-hidden="true"></i> </span>
                                                    View Product
                                                </a>
                                                <a class="dropdown-item"
                                                    href="{{route('mall.vendor', Str::slug($vid->job->vendor->vendor_station))}}">
                                                    <span class="guser-menu-icon"><i class="fas fa-store"></i></span>
                                                    Visit Store
                                                </a>
                                                <a class="dropdown-item" href="#">
                                                    <span class="guser-menu-icon"><i class="fa fa-ban"
                                                            aria-hidden="true"></i></span>
                                                    Block Store
                                                </a>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="info">
                                    <span class="sm-content">
                                        <i class="far fa-eye icon"></i>
                                        <span>{{ $vid->view_count }} Views</span>
                                    </span>
                                    <span class="sm-content">
                                        <i class="far fa-comments icon"></i>
                                        <span>{{ count($vid->comments) }} Comments</span>
                                    </span>
                                    <span class="sm-content">
                                        <span style="width: 10px; cursor:pointer;" class="dropdown-toggle"
                                            data-toggle="dropdown" aria-expanded="false">
                                            <img src="{{ asset('images/3_dots.svg') }}" class="icon " height="15">
                                        </span>
                                    </span>
                                </div>

                            </div>
                        </div>

                        @endforeach
                        @else
                        <h3><small>No Videos Yet</small></h3>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="btn_area text-center mt-3 mb-3 p-3">
        <a href="/guser"><button type="button" class="btn btn-secondary rounded-btn">View All</button></a>
    </div>
</section>
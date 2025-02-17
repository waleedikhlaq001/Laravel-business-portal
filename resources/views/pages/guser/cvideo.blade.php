<?php
use App\Http\Controllers\GeneralUserController;
?>
@extends('pages.app')
@push('scripts')
<script>
    document.title = "{{$featured_video->name}}";
</script>
@endpush
@push('css')
<style>
    .add-status {
        position: absolute;
        top: 0;
        margin-top: 44%;
        left: 0;
        margin-left: 37%;
        padding: 0.3rem 0.6rem;
        background-color: #94CA52;
    }

    .round-edges {
        border-radius: 15px;
    }

    aside {
        position: absolute !important;
    }

    /**
        *social media share buttons style
        **/
    .share-btn {
        font-size: 28px;
        line-height: 30px;
        width: 40px;
        height: 40px;
        text-decoration: none;
        margin: 5px 2px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .fa:hover {
        opacity: 0.7;
    }

    .fa-facebook {
        background: #3B5998;
        color: white;
    }

    .fa-twitter {
        background: #55ACEE;
        color: white;
    }

    .fa-google {
        background: #dd4b39;
        color: white;
    }

    .fa-linkedin {
        background: #007bb5;
        color: white;
    }

    .fa-youtube {
        background: #bb0000;
        color: white;
    }

    .fa-instagram {
        background: #125688;
        color: white;
    }

    .fa-pinterest {
        background: #cb2027;
        color: white;
    }

    .fa-snapchat-ghost {
        background: #fffc00;
        color: white;
        text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
    }

    .fa-skype {
        background: #00aff0;
        color: white;
    }

    .fa-android {
        background: #a4c639;
        color: white;
    }

    .fa-dribbble {
        background: #ea4c89;
        color: white;
    }

    .fa-vimeo {
        background: #45bbff;
        color: white;
    }

    .fa-tumblr {
        background: #2c4762;
        color: white;
    }

    .fa-vine {
        background: #00b489;
        color: white;
    }

    .fa-foursquare {
        background: #45bbff;
        color: white;
    }

    .fa-stumbleupon {
        background: #eb4924;
        color: white;
    }

    .fa-flickr {
        background: #f40083;
        color: white;
    }

    .fa-yahoo {
        background: #430297;
        color: white;
    }

    .fa-soundcloud {
        background: #ff5500;
        color: white;
    }

    .fa-reddit {
        background: #ff5700;
        color: white;
    }

    .fa-rss {
        background: #ff6600;
        color: white;
    }

    .overlay img {
        height: 35px;
        margin: auto;
        display: flex;
        position: absolute;
        top: 30%;
        left: 38%;
    }

</style>
@endpush

@section('content')
{{-- vendor video carousel --}}
<div class="row">
    <div id="partner-carousel" class="partner-carousel owl-carousel owl-theme owl-loaded">
        {{-- <div class="partner-item">
            <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="partner-image">
            <a id="" class="btn btn-success add-status d-block" href="#" role="button"><i class="fa fa-plus"></i></a>
            <div class="row text-black"><b style="text-align: center">John Doe</b></div>
        </div> --}}
        @if (count($creatives) > 0)
        @foreach ($creatives as $creative)
        <div class="partner-item">
            <img src="{{ $creative->user->image }}" onclick="creativeDetails({{ $creative->user->id }})"
                class="partner-image shadow">
            <div class="row text-black pt-2">
                <span class="partner-image-text p-0">
                    {{ Str::limit(ucfirst(strtolower($creative->user->last_name)), 8, '..') }}
                </span>
            </div>
        </div>
        @endforeach
        @endif

    </div>
</div>
{{-- /end vendor video carousel --}}

{{-- video hero session --}}
<section class="section">
    <div class="px-2 px-lg-4">
        <div class="row p-3">
            <div class="col-md-8 mvpr mb-3 pl-0">
                <div class="row pr-lg-3">
                    <div class="embed-responsive embed-responsive-16by9 shadow main-vid">
                        <img class="vicom-icon" src="{{ asset('images/group-2623.svg') }}">
                        <video class="embed-responsive-item" autoplay loop controls muted>
                            <source src="{{ $featured_video->file }}" type="video/mp4">
                        </video>
                    </div>

                </div>
                <div class="row p-3">
                    <!-- ShareThis BEGIN -->
                    <div class="sharethis-inline-share-buttons" style="display: none"></div><!-- ShareThis END -->
                    <button class="btn-sm share-it-btn mr-4" style="color:#94CA52" onclick="toggleShare()">
                        Share <i class="ml-4 fa fa-caret-down"></i></button>
                    <button class="btn-sm make-comment-btn text-white" onclick="openCommentForm()">Comment <i
                            class="fa fa-comments" style="color: #fff"></i></button>
                </div>

            </div>
            {{-- products aside video --}}
            <div class="col-md-4 p-3 vid-products shadow">

                <div class="row">
                    <span class="w-100" style="color: #6F3C96;font-family: 'poppins';">Top Selling</span>
                    <span class="w-100" style="height: 30px; margin-top: -10px;">
                        <hr style="border: 1px solid rgb(208 215 200);float: left;width: 100%;" />
                    </span>
                </div>

                <div class="overflow-vid-sidebar fine-scrollbar">
                    @if (count($related_products) > 0)
                    @foreach ($related_products as $product)
                    <?php
                                $directory = 'product_images/';
                                $files = Storage::disk('public')->allFiles($directory);
                                $randomFile = $files[rand(0, count($files) - 1)];
                                // dd($randomFile);
                                if (gettype(json_decode($product->image, true)) == "array" &&  count(json_decode($product->image, true)) > 0) {
                                    $image = "https://viccomma-videos.s3.us-east-2.amazonaws.com/product-images/".json_decode($product->image, true)[0];
                                } else {
                                    $image = '/img/no-image.png';
                                }
                                ?>
                    <div class="row my-vid-sidebar pb-3 my-2 w-100">
                        <div class="col-lg-5 col-5">
                            <div class="img-div">
                                <img src="{{ $image }}" class="">
                            </div>
                        </div>
                        <div class="col-lg-7 col-7 m-auto">
                            <h4><a class="text-dark" href="/mall/show/{{ $product->id }}" target="_blank"><small
                                        class="small-font">{{ucwords($product->name)}}</small></a></h4>
                            <div class="row">
                                <div class="col-4 p-2 pt-3 prod-price">
                                    {{$geo['currency_symbol']}}{{ number_format($product->price  * $geo['exchange_rate']) }}
                                </div>
                                <div class="col-8 p-2 text-center">
                                    <a href="/mall/products/{{ $product->id }}" class="btn-bag-it"
                                        style="border-radius: 20px;display: flex; align-items: center; justify-content: center;color:white !important"
                                        ii="{{ $product->id }}">Shop Now</a>

                                    <!-- <button class="btn-bag-it"
                                                    id="{{ $product->id }}">Bag It</button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <small>No Related products found</small>
                    @endif

                </div>
            </div>
            {{-- /end of products aside video --}}
        </div>
    </div>
</section>
{{-- /end video hero session --}}
{{-- start video category filters --}}
<section class="section mb-5">
    <div class="row px-4">
        <div class="col-md-8 p-3 mvr">
            <div class="row p-3 d-flex flex-wrap">
                <div class="col-6" style="max-width:249px">
                    <h2 class="guser-h2">
                        <img src="{{ asset('images/comment.svg') }}" alt="">
                        {{ count($featured_video->comments) }} Comments
                    </h2>
                </div>
                <div class="col-6" style="max-width:249px">
                    <h2 class="guser-h2">
                        <img src="{{ asset('images/visibility.svg') }}" alt="">
                        {{ $featured_video->view_count }} Views
                    </h2>
                </div>
                {{-- <div class="col order-4" style="max-width:249px">
                    <h2 style="color:#94CA52;font-size:21px">
                        <img src="{{asset('images/sorting-6611.svg')}}" alt="" height="35">
                SORT BY
                </h2>
            </div> --}}
        </div>
        <div class="row mb-5">
            <div class="col-md-12 mb-2" id="commentForm" style="display: none">
                <form method="post" action="#" id="guser-comment-form">
                    @csrf
                    <input type="hidden" id="vid" value="{{ $featured_video->id }}">
                    <div class="form-group mt-3">
                        <textarea class="form-control comment-textarea" id="ucomment"
                            placeholder="Add public comment"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="row float-end">
                            <button class="btn-sm share-it-btn" id="cancelCmtBtn">Cancel</button>
                            <button class="btn-sm make-comment-btn ml-2" id="commentBtn">Comment</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div id="commentsView" style="width:100%;float:left;margin-top:15px;padding-right: 15px;">
            {{-- <div class="col-md-8"> --}}
            @if (count($comments) > 0)
            @foreach ($comments as $com)
            <div class="mb-4">
                <div class="row">
                    <div class="col-md-1 col-1 p-2">
                        <img src="{{ $com->user->image }}" class="img-fluid author-img shadow" style="height: 50px;">
                    </div>
                    <div class="col-md-11 col-11 px-2 pb-2">
                        <div class="row">
                            <div class="col-10 pt-2">
                                <h4 class="comment-name mb-0" style="font-size: 20px;">{{ $com->user->first_name }}
                                    {{ $com->user->last_name }}</h4>
                                <span
                                    class="w-100 comment-details">{{ strftime('%b %d, %Y', strtotime($com->created_at)) }}
                                    @ {{ date('h:i a', strtotime($com->created_at)) }}</span>
                            </div>
                            <div class="col-2 pt-4">
                                <button class="btn btn-sm reply-btn float-end"
                                    onclick="replyComment('{{ $com->id }}')">Reply</button>
                            </div>
                        </div>
                        <div class="w-100 mt-2">
                            <p class="comment-text" style="font-size: 18px;">{{ $com->comment }}</p>
                        </div>
                    </div>
                </div>
                @if (GeneralUserController::hasResponse($com->id))
                <?php echo GeneralUserController::fetchCommentResponse($com->id); ?>
                @endif
                {{-- reply comment form --}}
                <div class="row" id="cmnt-response{{ $com->id }}" style="display: none">
                    <form method="post" action="#" id="guser-comment-reply-form{{ $com->id }}">
                        @csrf
                        <input type="hidden" id="cid{{ $com->id }}" value="{{ $com->id }}">
                        <div class="form-group ml-5">
                            <textarea class="form-control comment-textarea" id="ucommentresp{{ $com->id }}"
                                placeholder="Add public comment"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="float-end">
                                <button class="btn-sm share-it-btn" id="cancelCmtRespBtn{{ $com->id }}"
                                    onclick="cancelCommentResp('{{ $com->id }}')">Cancel</button>
                                <button class="btn-sm make-comment-btn ml-2" id="commentRespBtn{{ $com->id }}"
                                    onclick="postCommentResp('{{ $com->id }}','{{ $com->video_content_id }}')">Comment</button>
                            </div>
                        </div>
                    </form>
                </div>
                {{-- /end of reply comment form --}}
            </div>
        </div>
        @endforeach
        @else
        <small>Be the first to make a comment.</small>
        @endif
        {{-- </div> --}}
    </div>
    </div>

    <div class="col-md-4 p-3 vid-products shadow">
        <h5 class="pb-1">Related Videos<h5>
                <div class="overflow-vid-sidebar fine-scrollbar" style="height: 410px;">
                    @if (count($related) > 0)
                    @foreach ($related as $product)

                    <div class="row my-vid-sidebar pb-3 my-2 w-100">
                        <div class="col-lg-5 col-5">
                            <div class="embed-responsive embed-responsive-16by9 shadow other-vid">
                                <video playsinline muted id="vid{{ $product->id }}"
                                    class="embed-responsive-item theVideo{{ $product->id }}"
                                    poster="{{$product->video_thumb ?? '' }}">
                                    <data-src src="{{ $product->file }}" type="video/mp4"></data-src>
                                </video>

                                <div class="overlay" onclick="loadVideo('{{ $product->id }}')">
                                    <img src="{{ asset('images/video_icon.svg') }}" class="icon" height="15">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 col-7">
                            <h4><a class="text-dark" href="/video/{{$product->id}}" target="_blank"><small
                                        class="small-font">{{ucwords($product->name)}}</small></a></h4>
                            <div class="row mt-2">
                                <div class="col-12 p-2 pt-1 prod-price">
                                    <div class="pl-0 pt-1" style="font-size: 13px; color:#BDBDBD;">
                                        <img src="{{ asset('images/visibility.svg') }}" class="icon" height="15">
                                        <span class="pr-2">
                                            {{ $product->view_count }} Views
                                        </span>
                                        <img src="{{ asset('images/comment.svg') }}" class="icon" height="15">
                                        <span>
                                            {{ count($product->comments) }} Comments
                                        </span>
                                    </div>
                                </div>
                                <div class="d-none col-4 p-2 text-center">
                                    <!-- <a href="/mall/products/{{ $product->id }}" class="btn-bag-it" style="border-radius: 20px;display: flex; align-items: center; justify-content: center;" ii="{{ $product->id }}">View It</a> -->

                                    <!-- <button class="btn-bag-it"
                                                    id="{{ $product->id }}">Bag It</button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <small>No Related products found</small>
                    @endif

                </div>
    </div>

    </div>
    </div>
</section>

{{-- /end video category filters --}}
<!-- share button modal-->
<div class="modal fade" id="share-button-modal" tabindex="-1" aria-labelledby="shareButtonLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content mt-5">

            <div class="modal-header">
                <h5 class="modal-title" id="shareButtonLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h3 class="text-center" style="font-family: 'poppins';">Share</h3>
                <div class="col-md-10 m-auto">
                    <div class="d-flex" style="justify-content: space-between">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?=$url;?>&title={{ $featured_product->name }}"
                            target="_blank" rel="nofollow" class="fa fa-facebook facebook share-btn"></a>
                        <a href="https://twitter.com/share?text={{ $featured_product->name }}&url=<?=$url;?>"
                            rel="nofollow" target="_blank" class="fa fa-twitter twitter share-btn"></a>
                        <a href="https://api.whatsapp.com/send/?text=<?=$url;?>"
                            class="fa fa-whatsapp whatsapp share-btn"></a>
                        <a href="mailto:?subject={{ $featured_product->name }}&body=<?=$url;?>"
                            class="fa fa-envelope-o email share-btn" rel="nofollow" target="_blank"></a>
                        <a href="https://telegram.me/share/url?url=<?=$url;?>" class="fa fa-telegram telegram share-btn"
                            target="_blank">
                            <a href="https://www.pinterest.com/pin/create/button/?description={{ $featured_product->name }}&media=&url=<?=$url;?>"
                                rel="nofollow" class="fa fa-pinterest pinterest share-btn" target="_blank"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end of share button modal-->
<div class="modal fade" id="creative-details-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="creativeData">
                ...loading <i class="fa fa-spinner"></i>
            </div>
        </div>
    </div>
</div>
@auth
{{-- @include('pages.partials.footer') --}}
@endauth
@endsection
@push('scripts')
<script>
    const addToCartBtns = document.querySelectorAll(".btn-bag-i");
        const guestCart = [];
        const handleAddToCart = (product) => {
            //if the product is already in the cart, update the quantity
            const {
                id
            } = product;
            if (!sessionStorage.getItem("cartIdStore")) {
                sessionStorage.setItem("cartIdStore", JSON.stringify([id]));
                sessionStorage.setItem("cart", JSON.stringify([product]));
            } else {
                if (!JSON.parse(sessionStorage.getItem("cartIdStore")).includes(id)) {
                    sessionStorage.setItem(
                        "cart",
                        JSON.stringify([
                            ...JSON.parse(sessionStorage.getItem("cart")),
                            product,
                        ])
                    );
                    sessionStorage.setItem(
                        "cartIdStore",
                        JSON.stringify([
                            ...JSON.parse(sessionStorage.getItem("cartIdStore")),
                            id,
                        ])
                    );
                }
            }
        };
        for (let i = 0; i < addToCartBtns.length; i++) {
            addToCartBtns[i].addEventListener('click', function() {
                console.log(addToCartBtns[i].id)
                guestCart.push(addToCartBtns[i].id);
                //make a call to the server to add product to session
                axios.post(`${window.location.origin}/cartsession`, {
                    product_id: addToCartBtns[i].id
                }).then(function(response) {
                    console.log(response.data)
                    const {
                        message,
                        product,
                        cart_count
                    } = response.data;
                    swal({
                        title: "Product Added Successfully!",
                        text: message,
                        icon: "success",
                    });
                    handleAddToCart(product)
                    document.querySelector('#vicomma-cart-cta').innerHTML = cart_count;
                })
            })
        }
</script>

<script>
    function loadVideo(vid) {
            // $('#vid'+vid).click(function(event) {
            //     $('#theVideo'+vid).get(0).play();
            //     setTimeout(function() {
            //         $('#theVideo'+vid).get(0).pause();
            //         $('#theVideo'+vid).get(0).currentTime = 0;
            //     }, 7000);
            // });
            location.assign("/video/" + vid);
        }
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl);
        });
        $(document).ready(function() {
            $('body').addClass('sidebar-collapse');
            $(".overlay")
                .mouseenter(function() {
                    var video = $(this).prev();
                    $(video).get(0).play();
                })
                .mouseleave(function() {
                    var video = $(this).prev();
                    $(video).get(0).pause();
                });
        });
        function creativeDetails(cid) {
            $("#creativeData").html('...loading <i class="fa fa-spinner"></i>');
            $("#creative-details-modal").modal('show');
            $.get("/guser/fetchDetails/" + cid, function(data, status) {
                var resp = JSON.parse(data);
                $("#creativeData").html(`<div class="row">
                    <div class="col-lg-4 text-center">
                    <img src="${resp.user.image}" class="img-fluid shadow-sm" style="border-radius:50%;">
                    <p>Ratings</p>
                    <div class="text-muted text-sm">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="col-lg-8">
                    <p><b>Full Name:</b> ${resp.user.first_name}&nbsp;${resp.user.last_name}</p>
                    <p><b>Member Since:</b> ${moment(resp.user.created_at,"YYYYMMDD").fromNow()}</p>
                    <p><b>Jobs Awarded:</b> ${resp.all_jobs}</p>
                    <p><b>Jobs Delivered:</b> ${resp.jobs_delivered}</p>
                </div>
                <div class="row text-center">
                    <a href="${resp.url}" target="_blank"><button class="btn btn-info">View Portfolio</button></a>
                </div>
                </div>`);
                //console.log(data);
            });
        }
        function refreshComments(vid) {
            $("#commentsView").html('...getting comments <i class="fa fa-spinner"></i>');
            $.get("/guser/loadcomments/" + vid, function(data, status) {
                $("#commentsView").html(data);
            });
        }
</script>
<script>
    $(document).ready(function() {
            $("#commentBtn").click(function() {
                $("#guser-comment-form").submit(function(e) {
                    e.preventDefault();
                });
                var comment = $('#ucomment').val();
                var vid = $('#vid').val();
                $.ajax({
                    type: "POST",
                    url: "/guser/submitcomment",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        comment: comment,
                        vid_id: vid
                    },
                    dataType: "json",
                    beforeSend: function() {
                        $("#commentBtn").attr("disabled", true);
                        $("#commentBtn").html("<i class='fa fa-spin'></i> ...");
                    },
                    success: function(resp) {
                        if (resp.status === "Success") {
                            $('#ucomment').val('');
                            refreshComments(vid);
                        } else if (resp.status === "not_logged") {
                            swal("Oooops!", "You have to be logged in to make comment", "info")
                                .then((value) => {
                                    $("#commentBtn").attr("disabled", false);
                                    location.assign("/login");
                                });
                        } else {
                            swal("Oooops!", resp.status, "error").then((value) => {
                                $("#commentBtn").attr("disabled", false);
                            });
                        }
                        return;
                    },
                    complete: function() {
                        $("#commentBtn").html("Comment");
                        $("#commentBtn").attr("disabled", false);
                        return;
                    },
                    error: function(err) {
                        swal("Oooops!", "Something went wrong with your request...", "error")
                            .then((val) => {
                                $("#commentBtn").html("Comment");
                                $("#commentBtn").attr("disabled", false);
                            });
                        return;
                    }
                });
            });
            $("#cancelCmtBtn").click(function() {
                $("#guser-comment-form").submit(function(e) {
                    e.preventDefault();
                });
                $('#ucomment').val('');
            });
        });
        function openCommentForm() {
            var el = document.getElementById("commentForm");
            if (el.style.display == "block") {
                el.style.display = "none";
            } else {
                el.style.display = "block";
            }
        }
        function toggleShare() {
            $("#share-button-modal").modal('show');
        }
        function replyComment(cid) {
            var el = document.getElementById("cmnt-response" + cid);
            if (el.style.display == "block") {
                el.style.display = "none";
            } else {
                el.style.display = "block";
            }
        }
        function postCommentResp(cid, vid) {
            $("#guser-comment-reply-form" + cid).submit(function(e) {
                e.preventDefault();
            });
            var resp = $("#ucommentresp" + cid).val();
            //prepare ajax
            $.ajax({
                type: "POST",
                url: "/guser/submitcommentresp",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    comment: resp,
                    cid: cid
                },
                dataType: "json",
                beforeSend: function() {
                    $("#commentRespBtn" + cid).attr("disabled", true);
                    $("#commentRespBtn" + cid).html("<i class='fa fa-spin'></i> ...");
                },
                success: function(resp) {
                    if (resp.status === "Success") {
                        $("#ucommentresp" + cid).val("");
                        refreshComments(vid);
                    } else if (resp.status === "not_logged") {
                        swal("Oooops!", "You have to be logged in to make comment", "info").then((value) => {
                            $("#commentRespBtn" + cid).attr("disabled", false);
                            location.assign("/login");
                        });
                    } else {
                        swal("Oooops!", resp.status, "error").then((value) => {
                            $("#commentRespBtn" + cid).attr("disabled", false);
                        });
                    }
                    return;
                },
                complete: function() {
                    $("#commentRespBtn" + cid).html("Comment");
                    $("#commentRespBtn" + cid).attr("disabled", false);
                    return;
                },
                error: function(err) {
                    swal("Oooops!", "Something went wrong with your request...", "error").then((val) => {
                        $("#commentRespBtn" + cid).html("Comment");
                        $("#commentRespBtn" + cid).attr("disabled", false);
                    });
                    return;
                }
            });
        }
        function cancelCommentResp(cid) {
            $("#guser-comment-reply-form" + cid).submit(function(e) {
                e.preventDefault();
            });
            $("#ucommentresp" + cid).val("");
        }
        function addToCart(pid) {
            //depracated
            //@param pid = product id
            // var url = '/carts/'+pid;
            // $.get(url, function(data,status){
            //     swal("success","Added to cart","success");
            // });
        }
</script>
<script>
    $(document).ready(function() {
            $('#partner-carousel').owlCarousel({
                margin: 10,
                autoplay: false,
                smartSpeed: 800,
                itemsScaleUp: false,
                nav: false,
                dots: false,
                loop: false,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 5
                    },
                    768: {
                        items: 7
                    },
                    1000: {
                        items: 12
                    }
                }
            });
        });
</script>
@endpush
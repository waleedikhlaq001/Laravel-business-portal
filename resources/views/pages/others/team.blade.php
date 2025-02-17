@extends('pages.app')
@push('css')
    <style>
        .team-item img{
            height: 420px;
            border: 2px solid #492464;
            border-radius: 10px;
        }

        .team-item .overlay{
            display: none;
            border-radius: 10px;
        }

        .team-item:hover .overlay{
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
        }

        .team-item a i{
            color: #88e913 !important;
            font-size: 30px;
        }
    </style>
@endpush
@section('content')

@include('includes.messages')
<section class="sectionPT sectionPB">
    <div class="container-fluid">
        <div class="row">
            {{-- team carousel --}}

            <div class="col-md-12">
                <div class="sectionHeading3 text-center">
                    <h2>Meet Team vicomma</h2>
                    <div class="col-md-9 m-auto">
                        <p class="pe-5">
                            Ok, so who are the minds behind the vicomma platform? Below you will get to intimately meet the developers, designers, managers, and staff which make vicomma operational.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12 p-5">
                <div class="team-bg w-100">
                    {{-- <div class="owl-carousel owl-theme team-carousel pb-3"> --}}
                    <div id="team-carousel" class="team-carousel owl-carousel owl-theme owl-loaded row">

                        @if (count($team) > 0)
                            @foreach ($team as $rec)
                                <div class="team-item">
                                    <img src="{{$rec->image}}" alt="{{$rec->name}}" class="img-fluid team-img" style="object-fit: cover">
                                    <div class="overlay">
                                        <div class="p text-center">
                                            <strong>{{$rec->name}}</strong><br>
                                            {{$rec->position}}
                                            <div class="icons text-center mt-3">
                                                <a href="{{$rec->fb_link}}" class="mr-2">
                                                    <i class="fab fa-facebook-f"></i>
                                                </a>
                                                <a href="{{$rec->tw_link}}" class="mr-2">
                                                    <i class="fab fa-twitter"></i>
                                                </a>

                                                <a href="{{$rec->insta_link}}" class="">
                                                    <i class="fab fa-instagram"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@include('pages.partials.footer')
@endsection
@push('scripts')
    <script type="text/javascript">

    $(document).ready(function() {
        $('#team-carousel').owlCarousel({
            margin: 10,
            autoplay: true,
            smartSpeed: 800,
            itemsScaleUp: false,
            nav: true,
            loop: true,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 3
                },
                1000: {
                    items: 4
                }
            }
        });
    });

    </script>
@endpush

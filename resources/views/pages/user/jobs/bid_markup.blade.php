<div class="row g-3 bids">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="card jbCardContainer p-1 bg-transparent">
                                        <div class="row justify-content-center g-2">
                                            <div class="col-12 col-sm-12 col-md-4">
                                                <div class="bg-white rounded-0 p-2 bid-header">
                                                    <h6>Budget:
                                                        <span>{{ $job->currency->symbol }}{{ number_format($job->budget->min) }}
                                                            -
                                                            {{ $job->currency->symbol }}{{ number_format($job->budget->max) }}</span>
                                                    </h6>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-4">
                                                <div class="bg-white rounded-0 p-2 bid-header">
                                                    <h6>Bids:
                                                        <span>{{ count($bids) }}</span>
                                                    </h6>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-4">
                                                <div class="bg-white rounded-0 p-2 bid-header">
                                                    <h6>Avg. Bid:
                                                        <span>{{ $job->currency->symbol }}{{ number_format($bidAverage) }}</span>
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
      
@foreach ($bids as $bid)
                                    <div class="card shadow p-2 bg-white pb-3">
                                        <div
                                            class="card-header d-sm-block d-lg-flex justify-content-between border-bottom-0 pb-1">
                                            <div class="d-flex align-items-center">
                                                <div class="bdImage">
                                                    @php
                                                    $path = public_path('img/profile/') . $bid->influencer->image;
                                                    @endphp
                                                    @if (file_exists($path))
                                                    <img id="influencer-profile-pic-{{ $loop->index + 1 }}"
                                                        src="{{ asset('/img/profile/' . $bid->influencer->image) }}"
                                                        class="img-fluid" alt="{{ $bid->influencer->last_name }}">
                                                    @else
                                                    <img id="influencer-profile-pic-{{ $loop->index + 1 }}"
                                                        src="{{ $bid->influencer->image }}" class="img-fluid"
                                                        alt="{{ $bid->influencer->last_name }}">
                                                    @endif
                                                    <!-- <img src="{{ asset('/img/p-img.jpg') }}" class="img-fluid" alt=""> -->
                                                </div>
                                                <div class="ml-3">
                                                    <h6 class="font-weight-normal text-md mb-0"
                                                        id="influ-firstname-{{ $loop->index + 1 }}">
                                                        {{ $bid->influencer->first_name }}
                                                    </h6>
                                                    <span class="text-sm text-warning">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </span>
                                                    <p class="proposal pt-2 mb-1">
                                                        {{ $bid->proposal }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="ml-auto">
                                                <h6 class="mb-0">
                                                    {{ $bid->job->currency->symbol }}{{ number_format($bid->amount) }}
                                                </h6>
                                                <span class="text-muted text-sm">
                                                    in <span>{{ $bid->duration }}</span> Days
                                                </span>
                                            </div>
                                        </div>


                                        <div class="card-body p-0">
                                            <div class="jbDetailsSection ml-2 pl-5">


                                                <!-- {{ $bid->job->vendor->user->id }} -->
                                                <div class="d-sm-block d-lg-flex justify-content-end">
                                                    @if (($user->id == $job->vendor->user->id &&
                                                    $job->influencer_id == $bid->influencer_id) || ($user->id ==
                                                    $job->influencer_id && $bid->influencer_id == $job->influencer_id)
                                                    || (!$bid->chat_initiated && $user->id ==
                                                    $job->vendor->user->id) || ($bid->chat_initiated && $user->id
                                                    == $bid->influencer_id))
                                                    <!-- <form class="mb-0" action="{{ route('user.chat.register') }}">
                                                            <input type="hidden" id="influ-id-{{ $loop->index + 1 }}"
                                                                name="influencer_id" value="{{ $bid->influencer_id }}">
                                                            <input type="hidden" name="job_id" value="{{ $bid->job->id }}">
                                                            <input type="hidden" name="influencer_firstname"
                                                                value="{{ $bid->influencer->first_name }}" />
                                                            <input type="hidden" name="influencer_lastname"
                                                                value="{{ $bid->influencer->last_name }}" />
                                                            <input type="hidden" name="influencer_image"
                                                                value="{{ $bid->influencer->image }}" />
                                                            <input type="hidden" name="vendor_id"
                                                                value="{{ $job->vendor->user->id }}" />
                                                            <input type="hidden" name="projectName"
                                                                value="{{ $job->name }}" />
                                                            <button type="submit"
                                                                class="btn btn-outline-primary btn-sm rounded-pill mt-1 initiate-chat-{{ $loop->index + 1 }}"
                                                                id="initiate-chat"
                                                                value="{{ $loop->index + 1 }}">Chat</button>
                                                        </form> -->
                                                    <!-- <div id="vicomma-chat-btn"></div> -->
                                                    @if ($user->id == $job->vendor->user_id )
                                                    <input type="hidden" value="{{$user->id}}">
                                                    <input type="hidden" value="{{$bid->id}}">
                                                    <a class="chat-message-vendor" data-chatreceiver="">

                                                        <chat-btn :bid-prop="{{ $bid->id }}" :user-prop="{{$user->id}}"></chat-btn>
                                                        <!-- <button id="vicomma-chat-btn" class="btn btn-secondary mt-2 text-white me-3">Chat</button> -->
                                                    </a>
                                                    @endif
                                                    @endif
                                                    {{-- <button
                                                                                        class="btn btn-secondary btn-sm rounded-pill ml-sm-0 ml-lg-2 mt-1">Award</button> --}}
                                                    {{-- {{$bid->job->isAwarded}} --}}


                                                    {{-- @if ($user->hasRole('vendor') && $job->payment_milestone ===
                                                    0)
                                                    @if ($job->isAwarded && $user->id === $job->vendor->user->id
                                                    && $job->influencer_id === $bid->influencer_id)
                                                    <a id="deposit-initial"
                                                        href="{{ route('user.vendors.milestones.pay') }}?id={{ $job->unique_id }}&creative={{ $bid->influencer_id }}">
                                                        <button class="btn btn-success btn-block mt-2">Make
                                                            Deposit</button>
                                                    </a>
                                                    @endif
                                                    @elseif($user->hasRole('vendor') && $job->payment_milestone
                                                    === 1 && $video && $video->viewed_at)
                                                    <a id="cta-final"
                                                        href="{{ route('user.job.final.payment', $job->unique_id) }}">
                                                        <button class="btn btn-success btn-block mt-2">
                                                            Make Final
                                                            Payment
                                                        </button>
                                                    </a>
                                                    @else
                                                    @endif --}}
                                                    @if ($job->isAwarded && $user->hasRole('vendor') &&
                                                    $job->vendor->user_id == $user->id)
                                                    @if($pay)
                                                    <a href="javascript:void(0);" data-bs-target="#payCreative" data-bs-toggle="modal">
                                                        <button class="btn btn-success btn-block mt-2">Pay Milestone
                                                            {{$wallet->currency->symbol}}{{$pay->amt_due}}</button>
                                                    </a>
                                                    @endif
                                                    @endif

                                                    @if (!$bid->job->isAwarded && $user->id ==
                                                    $job->vendor->user->id)
                                                    <form class="mb-0" id="awardForm"
                                                        action="{{ route('user.jobs.bid.award') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" id="influ-id-{{ $loop->index + 1 }}"
                                                            name="influencer_id" value="{{ $bid->influencer_id }}">
                                                        <input type="hidden" name="job_id" value="{{ $bid->job->id }}">
                                                        <input type="hidden" name="bid_amount" value="{{ $bid->amount }}">
                                                        <button type="submit"
                                                            class="btn btn-success ml-sm-0 ml-lg-2 mt-2 pl-4 pr-4">Award</button>
                                                    </form>
                                                    @endif
                                                    {{-- @if ($user->id == $bid->influencer_id && !$job->isAwarded)
                                                    <a href="{{route('user.jobs.bid.edit', $bid->id)}}"
                                                    class="btn btn-secondary btn-sm rounded-pill ml-sm-0 ml-lg-2
                                                    mt-1">Edit</a>
                                                    @endif --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                                    </div>
                                                    </div>
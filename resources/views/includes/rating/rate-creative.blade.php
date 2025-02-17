@push('css')
    <style>
        .rating-stars .checked {
            color: orange;
        }

        .rating-stars .fa-star {
            cursor: pointer;
            font-size: 22px;
        }

        .rate-name{
            font-size: 18px;
            color: #8f8e91;
        }
    </style>
@endpush
<div class="modal fade" id="rateCreative" tabindex="-1" role="dialog" aria-labelledby="rateCreativeLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="rateCreativeLabel">
                    <i class="fa fa-exclamation-circle text-warning" aria-hidden="true"></i>
                    Rate Creative
                </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('rate.creative')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <p class="pl-5">Let the world know how you feel about this creative</p>
                    <div class="row p-5">
                        <div class="col-md-6">
                            <span class="rate-name">Skilled</span>
                            <div class="rating-stars" id="skilled">
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <input type="hidden" name="skilled_rating" value="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <span class="rate-name">Communication</span>
                            <div class="rating-stars" id="communication">
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <input type="hidden" name="communication_rating" value="">
                            </div>
                        </div>
                        <div class="col-md-6 mt-4">
                            <span class="rate-name">On Time Delivery</span>
                            <div class="rating-stars" id="otd">
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <input type="hidden" name="otd_rating" value="">
                            </div>
                        </div>
                        <div class="col-md-6 mt-4">
                            <span class="rate-name">Affordable</span>
                            <div class="rating-stars" id="affordable">
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <input type="hidden" name="affordable_rating" value="">
                            </div>
                        </div>
                        <div class="col-md-12 mt-4">
                            <span style="color: #8f8e91;">Would you use this Creative again?</span>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="reuse" value="I would use this creative again" checked>
                                    Yes
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="reuse" value="I would not use this creative again" checked>
                                    No
                                </label>
                            </div>
                        </div>

                        <div class="col-md-12 mt-2">
                           <div class="form-group">
                                <label for="comment">In your own words, say something about your Creative </label>
                                <textarea class="form-control" name="comment" id="" rows="5"></textarea>
                            </div>
                        </div>

                    </div>
                    <div class="d-flex pr-4">
                        <input type="hidden" name="job_id" value="{{$job->id}}">
                        <input type="hidden" name="vendor_id" value="{{$job->vendor_id}}">
                        <input type="hidden" name="user_id" value="{{$job->influencer_id}}">
                        <button type="submit" class="btn-sm ml-auto mr-4" style="border-radius: 20px;background: rebeccapurple;color: #fff;font-size: 13px;padding: 3px 16px;"> Submit </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        //mark rating stars
        $(document).ready(function () {
            $('#skilled').on('click', 'span', function () {
                var $this = $(this);
                $this.nextAll().removeClass('checked');
                $this.prevAll().addClass('checked');
                $this.addClass('checked');
                $('input[name="skilled_rating"]').val($this.index() + 1);
            });
            $('#communication').on('click', 'span', function () {
                var $this = $(this);
                $this.nextAll().removeClass('checked');
                $this.prevAll().addClass('checked');
                $this.addClass('checked');
                $('input[name="communication_rating"]').val($this.index() + 1);
            });
            $('#otd').on('click', 'span', function () {
                var $this = $(this);
                $this.nextAll().removeClass('checked');
                $this.prevAll().addClass('checked');
                $this.addClass('checked');
                $('input[name="otd_rating"]').val($this.index() + 1);
            });
            $('#affordable').on('click', 'span', function () {
                var $this = $(this);
                $this.nextAll().removeClass('checked');
                $this.prevAll().addClass('checked');
                $this.addClass('checked');
                $('input[name="affordable_rating"]').val($this.index() + 1);
            });
        });
    </script>
@endpush

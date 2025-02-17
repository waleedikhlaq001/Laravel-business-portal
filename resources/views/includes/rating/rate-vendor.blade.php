@push('css')
<style>
    .rating-stars .checked {
        color: orange;
    }

    .rating-stars .fa-star {
        cursor: pointer;
        font-size: 22px;
    }

    .rate-name {
        font-size: 18px;
        color: #8f8e91;
    }
</style>
@endpush
<div class="modal fade" id="rateVendor" tabindex="-1" role="dialog" aria-labelledby="rateVendorLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="rateVendorLabel">
                    <i class="fa fa-exclamation-circle text-warning" aria-hidden="true"></i>
                    Rate Vendor
                </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('rate.vendor')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <p class="pl-5">Let the world know how you feel about this Vendor</p>
                    <div class="row p-5">
                        <div class="col-md-6">
                            <span class="rate-name">Fair</span>
                            <div class="rating-stars" id="fair">
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <input type="hidden" name="fair_rating" value="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <span class="rate-name">Communication</span>
                            <div class="rating-stars" id="communication_v">
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <input type="hidden" name="communication_rating" value="">
                            </div>
                        </div>
                        <div class="col-md-6 mt-4">
                            <span class="rate-name">Easy to work with</span>
                            <div class="rating-stars" id="easy_to_work_with">
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <input type="hidden" name="easy_to_work_with_rating" value="">
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
    $(document).ready(function() {
        $('#easy_to_work_with').on('click', 'span', function() {
            var $this = $(this);
            $this.nextAll().removeClass('checked');
            $this.prevAll().addClass('checked');
            $this.addClass('checked');
            $('input[name="easy_to_work_with_rating"]').val($this.index() + 1);
        });
        $('#communication_v').on('click', 'span', function() {
            var $this = $(this);
            $this.nextAll().removeClass('checked');
            $this.prevAll().addClass('checked');
            $this.addClass('checked');
            $('input[name="communication_rating"]').val($this.index() + 1);
        });
        $('#fair').on('click', 'span', function() {
            var $this = $(this);
            $this.nextAll().removeClass('checked');
            $this.prevAll().addClass('checked');
            $this.addClass('checked');
            $('input[name="fair_rating"]').val($this.index() + 1);
        });

    });
</script>
@endpush
<div class="modal fade" id="payCreative" tabindex="-1" role="dialog" aria-labelledby="payCreativeLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="payCreativeLabel">
                    <i class="fa fa-exclamation-circle text-warning" aria-hidden="true"></i>
                    Confirm Your Action!
                </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>You are about to pay <b>{{$wallet->currency->symbol}}{{$pay->amt_due}}</b> to the Creative</p>
                @if ($pay->name == 'Video Watched')
                <p>This means that you have <b>Watched</b> and <b>Accept</b> the Video provided by the Creative.</p>
                @endif
                <div class="d-flex">
                    <form id="payFormS" action="{{route('wallet.pay', $pay->uid)}}" method="get">
                        <button class="btn btn-primary btn-sm ml-auto mt-3 float-left" id="payBtnS" type="submit">Proceed</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
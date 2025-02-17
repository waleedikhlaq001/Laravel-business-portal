@push('css')
    <style>
        .breakdown-item{
            display: flex;
            padding: 10px;
            margin: 10px 0;
            background: #dbebc6;
            border-radius: 5px;
            color: #476423;
            font-weight: 500;
            justify-content: space-between;
        }

        .total{
            font-size: 22px;
            font-weight: 700;
            background: #66972b;
            color: #fff;
        }

        .percTitle{
            padding: 10px;
            margin: 0px;
            text-align: center;
        }
    </style>
@endpush
<div class="modal fade" id="topupWallet" tabindex="-1" role="dialog" aria-labelledby="topupWalletLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="d-flex">
                <button type="button" class="close ml-auto pt-1 pr-2" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mb-0">
                <div class="d-flex">
                    <img class="m-auto" src="{{asset('img/wallet-topup.png')}}" style="height: 200px;" alt="wallet-topup">
                </div>    
                <p class="mb-0 text-center" style="color: #476423;">Add Money to your Wallet</p>
                <div style="margin: 20px">
                    <form action="{{route('gwallet.credit.topup')}}" method="post">
                        @csrf
                        <div class="form-group">
                        <input type="number"
                            class="form-control input-green" name="topup_amt" id="" placeholder="Enter Amount to be added to Wallet">
                        </div>
                        <div class="d-flex">
                            <input type="submit" class="btn btn-primary btn-sm ml-auto mt-3" role="button" value="Proceed">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        jQuery('document').ready(function() {
            
        });
    </script>
@endpush

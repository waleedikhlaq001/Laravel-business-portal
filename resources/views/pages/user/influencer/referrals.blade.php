@extends('pages.app')
<link rel="stylesheet" href="{{asset('/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('/css/select2-bootstrap.min.css')}}">
<style>
.hWlNG,
.TpYPE,
.flwOWS,
.ConENT,
.PSERev,
.SKills,
.cHarge,
.turARND,
.Curr,
.Clients,
.skills {
    display: none;
}

.form-group {
    transition: .5s;
}

.error {
    color: red;
    display: block;
    margin-top: .5rem;
}


#makebutton {
    display: none;
}

/* Media query for iPads and phones (screen width up to 768px) */
@media screen and (max-width: 768px) {
    #makebutton {
        display: block;
    }
}

.content-wrapper {
    background-color: #f6f6f6 !important;
}
</style>
<script src="/clipboard.min.js"></script>

@section('content')

<div class="container-fluid">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 card mx-auto d-flex"
                style="padding: 25px; border-radius: 25px; box-shadow: none; flex-direction: row;">
                <div style="flex: 2;">
                    <h3>Refer vendors<br />
                        Earn VCOINS
                    </h3>

                    <p style="font-size: 11px;">Earn 10vcoins for each vendor that signs up with your referral Code. You
                        can use the accumulated vcoins for subsequent transactions on vicomma.</p>
                    <button class="btn btn-primary " style="border-radius: 30px; font-size: 11px;" type='button' data-clipboard-text="http://vicomma.com/referral/{{Auth::user()->id}}">Copy your referral
                        link</button>
                </div>
                <div style="flex: 1;text-align: right;">
                    <img src="/reff.png" style="height: 200px;" />
                </div>
            </div>

            <div class="col-md-7 card mr-auto d-flex"
                style="padding: 25px; border-radius: 25px; box-shadow: none; justify-content: space-between;flex-direction: row; align-items: center;">
                <div style="">
                    <div class="d-flex" style="gap: 10px;">
                        <div class="d-flex" style="gap: 5px; flex-direction: column;">
                            <h5 style="font-size: 15px;margin-top: 15px;">Your Vendor Referral Statistics
                            </h5>
                            <h1 style="font-weight: bolder; margin-top: 10px;">VCOINS 6,000</h1>
                            <p style="font-size: 9px; margin-bottom: 0px; font-weight: bold;">EARNINGS THIS WEEK <span>ⓘ</span>
                        </div>
                    </div>
                </div>
                <div style="display: flex; flex-direction: column;gap: 20px;">
                <div>
                    
                <h3 style="font-weight: bolder; margin-top: 10px;">32</h3>
                <p style="font-size: 9px; margin-bottom: 0px; font-weight: bold;">TOTAL VENDORS REFERRED <span>ⓘ</span>
                </div>

                <div>
                    
                    <h3 style="font-weight: bolder; margin-top: 10px;">VCOINS 50,000</h3>
                    <p style="font-size: 9px; margin-bottom: 0px; font-weight: bold;">TOTAL EARNINGS <span>ⓘ</span>
                    </div>
                </div>
            </div>
        
            <div class="col-md-12 card mx-auto d-flex"
                style="padding: 25px; border-radius: 25px; box-shadow: none; flex-direction: row; align-items: center;">
                <div style="flex: 2;">
                    <div class="d-flex" style="gap: 10px;">
                        <img src="https://ui-avatars.com/api/?background=random&name=Stella+Sunday&size=128"
                            style="height: 50px; width: 50px; object-fit: cover; border-radius: 10px;" />
                        <div class="d-flex" style="gap: 5px; flex-direction: column;">
                            <h5 style="font-size: 17px;margin-top: 3px;">Ayomide Oloyede
                            </h5>
                            <p style="font-size: 11px; margin-bottom: 0px;">JOINED ON 21 NOV, 2023
                        </div>
                    </div>
                </div>
                <div style="flex: 1;text-align: right;">
                    <h6>10 VCOINS</h6>
                </div>
            </div>

            <div class="col-md-12 card mx-auto d-flex"
                style="padding: 25px; border-radius: 25px; box-shadow: none; flex-direction: row; align-items: center;">
                <div style="flex: 2;">
                    <div class="d-flex" style="gap: 10px;">
                        <img src="https://ui-avatars.com/api/?background=random&name=Stella+Sunday&size=128"
                            style="height: 50px; width: 50px; object-fit: cover; border-radius: 10px;" />
                        <div class="d-flex" style="gap: 5px; flex-direction: column;">
                            <h5 style="font-size: 17px; margin-top: 3px;" >Ayomide Oloyede
                            </h5>
                            <p style="font-size: 11px; margin-bottom: 0px;">JOINED ON 21 NOV, 2023
                        </div>
                    </div>
                </div>
                <div style="flex: 1;text-align: right;">
                    <h6>10 VCOINS</h6>
                </div>
            </div>

            <div class="col-md-12 card mx-auto d-flex"
                style="padding: 25px; border-radius: 25px; box-shadow: none; flex-direction: row; align-items: center;">
                <div style="flex: 2;">
                    <div class="d-flex" style="gap: 10px;">
                        <img src="https://ui-avatars.com/api/?background=random&name=Stella+Sunday&size=128"
                            style="height: 50px; width: 50px; object-fit: cover; border-radius: 10px;" />
                        <div class="d-flex" style="gap: 5px; flex-direction: column;">
                            <h5 style="font-size: 17px;margin-top: 3px;">Ayomide Oloyede
                            </h5>
                            <p style="font-size: 11px; margin-bottom: 0px;">JOINED ON 21 NOV, 2023
                        </div>
                    </div>
                </div>
                <div style="flex: 1;text-align: right;">
                    <h6>10 VCOINS</h6>
                </div>
            </div>



           


            

        </div>
    </div>
</div>
</div>
</div>
@push('scripts')
<script src="{{asset('/js/select2.min.js')}}"></script>

@endpush
@endsection
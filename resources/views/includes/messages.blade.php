@if ($message = Session::get('message'))
<div class="text-center">
    <p class="text-success mb-3 text-sm">
        <i class="fa fa-info" aria-hidden="true"></i>
        {{$message}}
    </p>
</div>
@endif
@if ($message = Session::get('error'))
<div class="text-center">
    <p class="text-danger mb-3 text-sm">
        <i class="fas fa-times-circle" aria-hidden="true"></i>
        {{dd($message)}}
    </p>
</div>
@endif

@if ($errors->any())
<div class="text-center">
    @foreach ($errors->all() as $error)
    <p class="text-danger text-sm">
        <i class="fas fa-times-circle" aria-hidden="true"></i>
        {{$error}}
    </p>
    @endforeach
</div>
@endif




@if ($message = Session::get('login-error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-size: .9rem;">
    <strong>Error!</strong> {{$message}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if ($message = Session::get('verified'))
<div class="modal fade" id="verifyEmail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 440px;">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6 class="text-center text-snd text-uppercase" style="margin-top: 14.4rem;">{{$message}}
                </h6>
                @if ($product_id = Session::get('product_first'))
                <div class="row">
                    <a href="/my-store/edit/{{$product_id}}" class="btn btn-secondary mb-2 mt-2"> Update My Product </a>
                    <a href="#" hre="{{route('user.jobs.my-jobs')}}" class="btn btn btn-outline-secondary" readonly
                        disabled>Get Bids</a>
                </div>
                @endif
                {{-- <h6 class="text-center text-snd text-uppercase" style="margin-top: 16rem;">Message</h6> --}}
                {{-- @if (Request::is('register'))
                        <a href="{{route('auth.login')}}" class="btn btn-primary btn-block">Login</a>
                @endif --}}
            </div>

        </div>
    </div>
</div>
@endif



@push('scripts')
@if ($message = Session::get('success'))
<input type="hidden" id="message" value="{{$message}}">
<script>
    jQuery(document).ready(function() {
        var message = document.querySelector('#message').value;
        console.log(message);
        swal({
            title: "Successful!",
            text: message,
            icon: "success",
        });
    })
</script>
@endif
@if ($message = Session::get('swal-error'))
<input type="hidden" id="message" value="{{$message}}">
<script>
    jQuery(document).ready(function() {
        var message = document.querySelector('#message').value;
        console.log(message);
        swal({
            title: "Error!!",
            text: message,
            icon: "error",
        });
    })
</script>
@endif

@if ($message = Session::get('swal-info'))
<input type="hidden" id="message" value="{{$message}}">
<script>
    jQuery(document).ready(function() {
        var message = document.querySelector('#message').value;
        console.log(message);
        swal({
            title: "Oh Sorry...",
            text: message,
            icon: "info",
        });
    })
</script>
@endif
@if ($message = Session::get('bank-error'))
<input type="hidden" id="message" value="{{$message}}">
<script>
    jQuery(document).ready(function() {
        var message = document.querySelector('#message').value;
        console.log(message);
        swal({
            title: "Error!!",
            text: message,
            icon: "error",
            buttons: {
                cancel: {
                    text: "Cancel",
                    value: true,
                    visible: true,
                    className: "bg-warning",
                    closeModal: true,
                },
                confirm: {
                    text: "Add Account",
                    value: true,
                    visible: true,
                    className: "",
                    closeModal: true
                }
            },
        }).then(function() {
            window.location = "/payment-method/list";
        });
    });
</script>
@endif
<script>
    $(document).ready(function() {
        $('#verifyEmail').modal('show')
    })
</script>
@endpush


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verify Email</title>
</head>
<style>
body {
    font-family: Arial;
}
.container,
.container-fluid,
.container-lg,
.container-md,
.container-sm,
.container-xl,
.container-xxl {
    width: 100%;
    padding-right: 1rem;
    padding-left: 1rem;
    margin-right: auto;
    margin-left: auto;
}
@media (min-width: 576px) {
    .container,
    .container-sm {
        max-width: 540px;
    }
}
@media (min-width: 768px) {
    .container,
    .container-md,
    .container-sm {
        max-width: 720px;
    }
}
@media (min-width: 992px) {
    .container,
    .container-lg,
    .container-md,
    .container-sm {
        max-width: 960px;
    }
}
@media (min-width: 1200px) {
    .container,
    .container-lg,
    .container-md,
    .container-sm,
    .container-xl {
        max-width: 1140px;
    }
}
@media (min-width: 1400px) {
    .container,
    .container-lg,
    .container-md,
    .container-sm,
    .container-xl,
    .container-xxl {
        max-width: 1320px;
    }
}
.btn {
    display: inline-block;
    margin-top: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #fff;
    text-align: center;
    text-decoration: none;
    vertical-align: middle;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    user-select: none;
    background-color: #198754;
    border: 1px solid #198754;
    padding: .375rem .75rem;
    font-size: 1rem;
    border-radius: .25rem;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}

.col {
    width: 80%;
    margin-left: auto;
    margin-right: auto;
    margin-top: 5rem;
    border-radius: 10px;
}
.card {
    border: 1px solid #eeeeee;
    padding: 50px;
    margin-top: 1rem;
}
.flex {
    display: flex;
    align-content: space-between;
}
.time {
    margin-left: auto;
}
</style>
<body>

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="flex">
                    <div>
                        <img src="{{asset('/img/logo-text.png')}}" width="150" alt="">
                    </div>
                    <div class="time">
                        <h4 style="margin-bottom: 2px; margin-top: 5px;">Notification!</h4>
                        {{date("F j, Y")}}
                    </div>
                </div>
                <div class="card border border-1 rounded">
                    <h2 class="text-black  font-weight-bold">Hi {{$user->last_name}} {{$user->first_name}} </h2>
                    <p>
                       Vicomma.com has received a request to reset the password for your account. If you did not request to reset your password, please ignore this email.
                    </p>
                    <a href="{{route('auth.reset.password.get', $token)}}" class="btn btn-success mt-2">Reset Password Now!</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

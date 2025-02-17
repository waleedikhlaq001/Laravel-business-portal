<?php

namespace App\Exceptions;

use Illuminate\Http\Request;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use App\Notifications\NotFound;
use Mail;
use Auth;
use Carbon\Carbon;
use Stevebauman\Location\Facades\Location;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
        $this->renderable(function (\Exception $e, Request $request) {
            if ($e->getPrevious() instanceof \Illuminate\Session\TokenMismatchException) {
                return redirect()->back();
            };
            if ($this->isHttpException($e)) {
                if ($e instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {

                    $agent = $request->userAgent();
                    $ip = $request->getClientIp(); /* Static IP address */
                    $loc_info = Location::get($ip);
                    $location = $loc_info && $loc_info->cityName ? "$loc_info->cityName, $loc_info->countryName" : "";
                    $user = Auth::user();
                    $details = [
                        'user' => $user ? $user->last_name . ' ' . $user->first_name . ' / ' . $user->email : "",
                        "agent" => "$agent",
                        "location" => "$location",
                        "time" => Carbon::now(),
                        'message' => 'Hi, Admin, a user Encountered a 404 page.'
                    ];
                    // Mail::to("adminerrors@gmail.com")->send(new NotFound($details));
                }
            }
        });
    }
}

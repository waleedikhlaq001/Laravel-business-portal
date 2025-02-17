<?php
namespace App\Providers;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(UrlGenerator $url)
    {

        Validator::extend('strong_password', function ($attribute, $value, $parameters, $validator) {
            $uppercase = preg_match('~[A-Z]~', $value);
            $lowercase = preg_match('~[a-z]~', $value);
            $number = preg_match('~[0-9]~', $value);
            $specialChars = preg_match('~[!@#$%^&*()\-_=+{};:,<.>/?\[\]]~', $value);
    
            return $uppercase && $lowercase && $number && $specialChars && strlen($value) >= 8;
        });

        $this->app->singleton(\Makeable\LaravelCurrencies\Contracts\BaseCurrency::class , function () {
            return \Makeable\LaravelCurrencies\Currency::fromCode('USD');
        });

        if (env('APP_ENV') != 'local' && env('REDIRECT_HTTPS')) {
            $url->forceScheme('https');
        }
        Paginator::useBootstrap();
    }
}

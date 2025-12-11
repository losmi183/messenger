<?php

namespace App\Providers;

use App\Services\JWTServices;
use App\Mail\Transport\ResendTransport;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Mail;
use Resend;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(JWTServices::class, JWTServices::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Mail::extend('resend', function ($config) {
            return new ResendTransport(
                config('services.resend.key')
            );
        });

    }
}

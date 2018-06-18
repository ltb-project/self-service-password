<?php

namespace PwnedPasswords\Providers;
 
use PwnedPasswords\PwnedPasswords;
use Illuminate\Support\ServiceProvider;

class LaravelServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PwnedPasswords::class, function ($app) {
            $pp = new PwnedPasswords();
            $pp->setMethod(PwnedPasswords::CURL);
            $pp->setCurlOptions([]);
            return $pp;
        });
    }
}

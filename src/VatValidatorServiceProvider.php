<?php

namespace Codelayer\VatValidator;

use Illuminate\Support\ServiceProvider;

class VatValidatorServiceProvider extends ServiceProvider
{
    /**
     * Boot the package services.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/vat-validator'),
        ]);

        $this->loadTranslationsFrom(__DIR__.'/../resources/lang/', 'vat-validator');
    }

    /**
     * Register the package services.
     */
    public function register()
    {
        $this->app->singleton('vat-format', VatFormat::class);
    }

    /**
     * @return array
     */
    public function provides()
    {
        return [
            'vat-format',
        ];
    }
}

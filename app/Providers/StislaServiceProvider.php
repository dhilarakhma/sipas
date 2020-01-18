<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class StislaServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {

        \Schema::defaultStringLength(191);
        \Route::resourceVerbs([
            'create'    => 'tambah',
            'edit'      => 'ubah',
        ]);

        \Blade::include('stisla.components.input', 'input');
        \Blade::include('stisla.components.email', 'email');
        \Blade::include('stisla.components.password', 'password');
        \Blade::include('stisla.components.number', 'number');
        \Blade::include('stisla.components.gambar', 'gambar');
        \Blade::include('stisla.components.gambar', 'image');
        \Blade::include('stisla.components.file', 'file');
        \Blade::include('stisla.components.excel', 'excel');
        \Blade::include('stisla.components.textarea', 'textarea');
        \Blade::include('stisla.components.select', 'select');
        \Blade::include('stisla.components.select2', 'select2');
        \Blade::include('stisla.components.datepicker', 'datepicker');
        \Blade::include('stisla.components.timemask', 'timemask');
        \Blade::include('stisla.components.uangmask', 'uangmask');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['stisla'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {

    }
}

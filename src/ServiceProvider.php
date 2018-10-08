<?php

namespace Helldar\NotifyExceptions;

use Helldar\NotifyExceptions\Services\NotifyException;
use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

class ServiceProvider extends IlluminateServiceProvider
{
    const CONFIG_PATH = __DIR__ . '/config/notifex.php';

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            self::CONFIG_PATH => config_path('notifex.php'),
        ]);
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(self::CONFIG_PATH, 'notifex');

        $this->app->singleton('notifex', NotifyException::class);
    }

    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function provides()
    {
        return ['notifex'];
    }
}

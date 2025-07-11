<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // You can bind your use case interfaces to their implementations here
        $this->app->bind(
            \App\UseCases\Contracts\Pacientes\UpdateInterface::class,
            \App\UseCases\Modules\Pacientes\UpdateUseCases::class
        );

        $this->app->bind(
            \App\Repositories\Contracts\PacienteRepositoryInterface::class,
            \App\Repositories\Modules\PacienteRepository::class
        );

        $this->app->bind(
            \App\UseCases\Contracts\Pacientes\CreateInterface::class,
            \App\UseCases\Modules\Pacientes\CreateUseCases::class
        );

        $this->app->bind(
            \App\UseCases\Contracts\Tecnicos\CreateInterface::class,
            \App\UseCases\Modules\Tecnicos\CreateUseCases::class
        );

    }
}

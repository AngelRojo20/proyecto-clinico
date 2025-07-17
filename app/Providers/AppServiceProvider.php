<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\UseCases\Contracts\Pacientes\ShowInterface;
use App\UseCases\Modules\Pacientes\ShowUseCases;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ShowInterface::class, ShowUseCases::class);
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

        $this->app->bind(
            \App\UseCases\Contracts\Tecnicos\UpdateInterface::class,
            \App\UseCases\Modules\Tecnicos\UpdateUseCases::class
        );
        $this->app->bind(
            \App\Repositories\Contracts\TecnicoRepositoryInterface::class,
            \App\Repositories\Modules\TecnicoRepository::class
        );
        $this->app->bind(
            \App\UseCases\Contracts\Muestras\CreateInterface::class,
            \App\UseCases\Modules\Muestras\CreateUseCases::class
        );
        $this->app->bind(
            \App\UseCases\Contracts\Muestras\UpdateInterface::class,
            \App\UseCases\Modules\Muestras\UpdateUseCases::class
        );
        $this->app->bind(
            \App\Repositories\Contracts\MuestraRepositoryInterface::class,
            \App\Repositories\Modules\MuestraRepository::class
        );
    }
}

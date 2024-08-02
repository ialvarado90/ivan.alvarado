<?php

namespace App\Providers;

use App\Contracts\PedidoEstadoRepositoryInterface;
use App\Contracts\PedidoEstadoServiceInterface;
use App\Contracts\PedidosDetailRepositoryInterface;
use App\Contracts\PedidosDetailServiceInterface;
use App\Contracts\PedidosRepositoryInterface;
use App\Contracts\PedidosServiceInterface;
use App\Contracts\ProductosRepositoryInterface;
use App\Contracts\ProductosServiceInterface;
use App\Contracts\RepartidorRepositoryInterface;
use App\Contracts\RepartidorServiceInterface;
use App\Contracts\RolesRepositoryInterface;
use App\Contracts\RolesServiceInterface;
use App\Contracts\UserRepositoryInterface;
use App\Contracts\UserServiceInterface;
use App\Contracts\UserTokenRepositoryInterface;
use App\Contracts\UserTokenServiceInterface;
use App\Repositories\PedidoEstadoRepository;
use App\Repositories\PedidosDetailRepository;
use App\Repositories\PedidosRepository;
use App\Repositories\ProductosRepository;
use App\Repositories\RepartidorRepository;
use App\Repositories\RolesRepository;
use App\Repositories\UserRepository;
use App\Repositories\UserTokenRepository;
use App\Services\PedidoEstadoService;
use App\Services\PedidosDetailService;
use App\Services\PedidosService;
use App\Services\ProductosService;
use App\Services\RepartidorService;
use App\Services\RolesService;
use App\Services\UserService;
use App\Services\UserTokenService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(UserTokenServiceInterface::class, UserTokenService::class);
        $this->app->bind(UserTokenRepositoryInterface::class, UserTokenRepository::class);
        $this->app->bind(RolesRepositoryInterface::class, RolesRepository::class);
        $this->app->bind(RolesServiceInterface::class, RolesService::class);
        $this->app->bind(ProductosServiceInterface::class, ProductosService::class);
        $this->app->bind(ProductosRepositoryInterface::class, ProductosRepository::class);
        $this->app->bind(PedidosServiceInterface::class, PedidosService::class);
        $this->app->bind(PedidosRepositoryInterface::class, PedidosRepository::class);
        $this->app->bind(PedidosDetailServiceInterface::class, PedidosDetailService::class);
        $this->app->bind(PedidosDetailRepositoryInterface::class, PedidosDetailRepository::class);
        $this->app->bind(PedidoEstadoServiceInterface::class, PedidoEstadoService::class);
        $this->app->bind(PedidoEstadoRepositoryInterface::class, PedidoEstadoRepository::class);
        $this->app->bind(RepartidorServiceInterface::class, RepartidorService::class);
        $this->app->bind(RepartidorRepositoryInterface::class, RepartidorRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

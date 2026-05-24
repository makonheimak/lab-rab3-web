<?php

namespace MaksimYurash\EcommerceSuite;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Http\Client\Factory as HttpFactory;
use MaksimYurash\EcommerceSuite\Http\Middleware\CheckApiVersion;
use MaksimYurash\EcommerceSuite\Services\Currency\CurrencyRateManager;
use MaksimYurash\EcommerceSuite\Services\Delivery\DeliveryCostManager;

class EcommerceSuiteServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/ecommerce-suite.php', 'ecommerce-suite');

        $this->app->singleton(CurrencyRateManager::class, function ($app) {
            return new CurrencyRateManager($app['cache.store'], $app['config'], $app->make(HttpFactory::class));
        });

        $this->app->singleton(DeliveryCostManager::class, function ($app) {
            return new DeliveryCostManager($app['config'], $app->make(HttpFactory::class));
        });

        $this->app->alias(CurrencyRateManager::class, 'ecommerce.currency');
        $this->app->alias(DeliveryCostManager::class, 'ecommerce.delivery');
    }

    public function boot(Router $router): void
    {
        $router->aliasMiddleware('ecommerce.api.version', CheckApiVersion::class);

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'ecommerce-suite');
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');

        $this->publishes([
            __DIR__ . '/../config/ecommerce-suite.php' => config_path('ecommerce-suite.php'),
        ], 'ecommerce-suite-config');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/ecommerce-suite'),
        ], 'ecommerce-suite-views');

        $this->publishes([
            __DIR__ . '/../database/migrations' => database_path('migrations'),
        ], 'ecommerce-suite-migrations');

        $this->publishes([
            __DIR__ . '/../database/factories' => database_path('factories/EcommerceSuite'),
            __DIR__ . '/../database/seeders' => database_path('seeders/EcommerceSuite'),
        ], 'ecommerce-suite-database');

        $this->publishes([
            __DIR__ . '/../tests' => base_path('tests/EcommerceSuite'),
        ], 'ecommerce-suite-tests');
    }
}

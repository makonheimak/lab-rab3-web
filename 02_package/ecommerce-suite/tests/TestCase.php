<?php

namespace MaksimYurash\EcommerceSuite\Tests;

use MaksimYurash\EcommerceSuite\EcommerceSuiteServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app): array
    {
        return [EcommerceSuiteServiceProvider::class];
    }

    protected function defineEnvironment($app): void
    {
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
        $app['config']->set('ecommerce-suite.default_api_version', 1);
    }
}

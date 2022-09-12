<?php namespace Shufo\LaravelOpenSearch\Tests;

use Shufo\LaravelOpenSearch\Facade;
use Shufo\LaravelOpenSearch\ServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;


/**
 * Class TestCase
 *
 * @package Tests
 */
abstract class TestCase extends Orchestra
{

    /**
     * @inheritdoc
     */
    protected function getPackageProviders($app)
    {
        return [
            ServiceProvider::class,
        ];
    }

    /**
     * @inheritdoc
     */
    protected function getPackageAliases($app)
    {
        return [
            'OpenSearch' => Facade::class,
        ];
    }
}

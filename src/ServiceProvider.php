<?php 

namespace Shufo\LaravelOpenSearch;

use OpenSearch\Client;
use Illuminate\Container\Container;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Laravel\Lumen\Application as LumenApplication;

/**
 * Class ServiceProvider
 *
 * @package Shufo\LaravelOpenSearch
 */
class ServiceProvider extends BaseServiceProvider
{

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->setUpConfig();
    }
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;

        $app->singleton('opensearch.factory', function($app) {
            return new Factory();
        });

        $app->singleton('opensearch', function($app) {
            return new Manager($app, $app['opensearch.factory']);
        });

        $app->alias('opensearch', Manager::class);

        $app->singleton(Client::class, function(Container $app) {
            return $app->make('opensearch')->connection();
        });
    }

    protected function setUpConfig(): void
    {
        $source = dirname(__DIR__) . '/config/opensearch.php';

        if ($this->app instanceof LaravelApplication) {
            $this->publishes([$source => config_path('opensearch.php')], 'config');
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('opensearch');
        }

        $this->mergeConfigFrom($source, 'opensearch');
    }
}

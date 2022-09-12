<?php namespace Shufo\LaravelOpenSearch;

use Shufo\LaravelOpenSearch\Console\Command\AliasCreateCommand;
use Shufo\LaravelOpenSearch\Console\Command\AliasRemoveIndexCommand;
use Shufo\LaravelOpenSearch\Console\Command\AliasSwitchIndexCommand;
use Shufo\LaravelOpenSearch\Console\Command\IndexCreateCommand;
use Shufo\LaravelOpenSearch\Console\Command\IndexCreateOrUpdateMappingCommand;
use Shufo\LaravelOpenSearch\Console\Command\IndexDeleteCommand;
use Shufo\LaravelOpenSearch\Console\Command\IndexExistsCommand;
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
        $this->setUpConsoleCommands();
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

    private function setUpConsoleCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                AliasCreateCommand::class,
                AliasRemoveIndexCommand::class,
                AliasSwitchIndexCommand::class,
                IndexCreateCommand::class,
                IndexCreateOrUpdateMappingCommand::class,
                IndexDeleteCommand::class,
                IndexExistsCommand::class,
            ]);
        }
    }
}

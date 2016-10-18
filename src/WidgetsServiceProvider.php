<?php

namespace Tequila\Widgets;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Tequila\Widgets\Console\Commands\WidgetMake;

class WidgetsServiceProvider extends ServiceProvider
{

    protected $commands = [
        WidgetMake::class
    ];

    public function boot()
    {
        $this->publishConfig();
        $this->initBladeDirectives();
    }

    public function register()
    {

        $this->mergeConfig();
        $this->registerManager();
        $this->registerCommands();
    }

    private function initBladeDirectives()
    {
        Blade::directive('widget', function ($expression) {
            return "<?php app('widgets')->run($expression); ?>";
        });
    }

    public function provides()
    {
        return ['widgets'];
    }

    private function mergeConfig()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/widgets.php',
            'widgets'
        );
    }

    private function publishConfig()
    {
        $this->publishes([
            __DIR__.'/../config/widgets.php' => config_path('widgets.php'),
        ]);
    }

    private function registerManager()
    {
        $this->app->singleton('widgets', function ($app) {
            return new WidgetsManager($app);
        });
    }

    private function registerCommands()
    {
        return $this->commands($this->commands);
    }
}

<?php

namespace Tequila\Widgets;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class WidgetsServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->publishConfig();
        $this->initBladeDirectives();
    }

    public function register()
    {
        $this->mergeConfig();
        $this->registerManager();
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
}

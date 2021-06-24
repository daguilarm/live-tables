<?php

declare(strict_types=1);

namespace Daguilarm\LiveTables;

use Daguilarm\LiveTables\Facades\LiveTables;
use Daguilarm\LiveTables\Facades\LiveTablesProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

/**
 * Class LaravelBelichTablesServiceProvider.
 */
final class LiveTablesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        // Publish and configure resources and config
        $this->publishAndConfigure();

        // Blade directives
        $this->bladeDirectives();
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'live-tables');

        // Facade
        $this->app->register(LiveTablesProvider::class);
        AliasLoader::getInstance()->alias('LiveTables', LiveTables::class);
    }

    /**
     * Publish and configure the config and the resources.
     */
    private function publishAndConfigure(): void
    {
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'live-tables');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'live-tables');

        // Only on console
        if ($this->app->runningInConsole()) {

            // Publish the config
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('live-tables.php'),
            ], 'config');

            // Publish the views
            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/live-tables'),
            ], 'views');

            // Publish the localization
            $this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/live-tables'),
            ], 'lang');
        }
    }

    /**
     * Generate the Blade directives.
     */
    public function bladeDirectives()
    {
        // Blade directives
        Blade::directive('liveTablesCss', static function ($expression) {
            $css = file_get_contents(__DIR__.'/../resources/css/live-tables.min.css');
            $customCss = str_replace('@backGroundColor', config('live-tables.loadingColor'), $css);

            return sprintf('<style>%s</style>', trim($customCss));
        });
    }
}

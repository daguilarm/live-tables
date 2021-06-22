<?php

declare(strict_types=1);

namespace Daguilarm\LiveTables\Facades;

use Daguilarm\LiveTables\LiveTables;
use Illuminate\Support\ServiceProvider;

final class LiveTablesProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        $this->app->singleton('LiveTables', static function () {
            return new LiveTables();
        });
    }
}

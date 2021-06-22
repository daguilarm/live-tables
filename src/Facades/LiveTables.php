<?php

declare(strict_types=1);

namespace Daguilarm\LiveTables\Facades;

use Illuminate\Support\Facades\Facade;

final class LiveTables extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'LiveTables';
    }
}

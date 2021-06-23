<?php

declare(strict_types=1);

namespace Daguilarm\LiveTables;

use Daguilarm\BelichTables\Views\Column;
use Illuminate\Support\Collection;

final class Helpers
{
    /**
     * Get the include path for the views.
     */
    public function include(string $path): string
    {
        return sprintf(
            'live-tables::%s.%s',
            config('live-tables.theme'),
            $path
        );
    }

    /**
     * Set column order.
     *
     * @param array<string> $options
     */
    public function orderBy(Column $column, array $options): string
    {
        return $column->getAttribute() !== $options['columnSortBy']
            ? 'reorder'
            : $options['columnSortDirection'];
    }
}

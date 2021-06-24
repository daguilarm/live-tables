<?php

declare(strict_types=1);

namespace Daguilarm\LiveTables;

use Daguilarm\LiveTables\Views\Column;
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
     * Toogle column order.
     */
    public function toogleDirection(string $currentField, string $field, string $direction): string
    {
        // When a column is changed we want to reset the order.
        if($currentField !== $field) {
            return 'ASC';
        }

        return $direction === 'ASC'
            ? 'DESC'
            : 'ASC';
    }

    /**
     * Table background colors, including: zebra striped table.
     *
     * @param array<string> $options
     */
    public function rowBackgroundColor(object $loop, array $options): string
    {
        if ($options['rowAlternateBackground']) {
            if ($loop->odd) {
                return $options['rowBackgroundColor'];
            }
            return $options['rowBackgroundColorAlternate'];
        }

        return $options['rowBackgroundColor'];
    }

    /**
     * Table background colors, including: zebra striped table.
     *
     * @param array<string> $highlight
     * @param array<string> $options
     *
     * @return string | void
     */
    public function columnHighlight(string $column, array $highlight, array $options)
    {
        if (in_array($column, $highlight)) {
            return $options['columnHighlight'];
        }
    }
}

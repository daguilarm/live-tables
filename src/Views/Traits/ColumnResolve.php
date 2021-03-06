<?php

declare(strict_types=1);

namespace Daguilarm\LiveTables\Views\Traits;

use Daguilarm\LiveTables\Facades\LiveTables;
use Daguilarm\LiveTables\Views\Column;

trait ColumnResolve
{
    protected bool $asHtml = false;

    /**
     * Html column.
     */
    public function asHtml(): self
    {
        $this->asHtml = true;

        return $this;
    }

    /**
     * Html column.
     */
    public function notAsHtml(): self
    {
        $this->asHtml = false;

        return $this;
    }

    /**
     * Check if the column is raw.
     */
    public function isHtml(): bool
    {
        return $this->asHtml;
    }

    /**
     * Resolve the column.
     */
    public function resolveColumn(Column $column, object $model): bool | int | float | object | string | null
    {
        // Get the value
        $value = data_get($model, $column->getAttribute());

        // Resolve type for value
        if ($value) {
            $value = $this->resolveType($value);

        // No results
        } else {
            $value = config('live-tables.noResults');
        }

        // Resolving the column as a view
        if ($column->isRenderable()) {
            return $column->renderCallback($model);
        }

        // Format the column
        if ($column->isFormatted()) {
            return $column->formatted($value);
        }

        return $value;
    }
}

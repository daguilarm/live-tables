<?php

declare(strict_types=1);

namespace Daguilarm\LiveTables\Components\Table;

use Daguilarm\LiveTables\Facades\LiveTables;

trait SortsTrait
{
    public string $sortField;
    public string $sortDirection;

    /**
     * Sorting columns.
     */
    public function orderBy(string $attribute, string $direction): void
    {
        $this->sortField = $attribute;
        $this->sortDirection = $direction;
    }

    /**
     * Sorting field.
     */
    public function getSortField(): string
    {
        return $this->sortField ?? $this->options['columnSortBy'];
    }

    /**
     * Sorting direction.
     */
    public function getSortDirection(): string
    {
        return $this->sortDirection ?? $this->options['columnSortDirection'];
    }
}

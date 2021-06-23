<?php

declare(strict_types=1);

namespace Daguilarm\LiveTables\Components\Table;

trait SortsTrait
{
    /**
     * Sorting columns.
     */
    public function orderBy(string $attribute, string $direction): void
    {
        $this->sortField = $attribute;
        $this->sortDirection = $this->toogleDirection($direction);
    }

    /**
     * Sorting field.
     */
    public function getSortField(): string
    {
        return $this->options['columnSortBy'];
    }

    /**
     * Sorting direction.
     */
    public function getSortDirection(): string
    {
        return $this->options['columnSortDirection'];
    }

    /**
     * Update order.
     */
    private function toogleDirection(string $direction): string
    {
        if ($direction === 'reorder') {
            return 'asc';
        }

        return $direction === 'asc'
            ? 'desc'
            : 'asc';
    }
}

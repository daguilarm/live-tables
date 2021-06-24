<?php

declare(strict_types=1);

namespace Daguilarm\LiveTables\Components\Filter;

use Daguilarm\LiveTables\Components\FilterComponent;
use Daguilarm\LiveTables\Facades\LiveTables;
use Illuminate\Database\Eloquent\Builder;

final class FilterByDate extends FilterComponent
{
    /**
     * Create a new field.
     */
    public function __construct(?string $uriKey = null)
    {
        parent::__construct($uriKey);

        // Set the view
        $this->view = LiveTables::include('sections.filters.date');
        // Set the unique key
        $this->uriKey = $uriKey ?? 'date';
    }

    /**
     * Set the filter query.
     *
     * @param int | float | string | null $value
     */
    public function apply(Builder $model, $value): Builder
    {
        // Set default values
        $column = $this->getColumn($model);
        $start = $value['start'] ?? null;
        $end = $value['end'] ?? null;

        if ($start) {
            $model->whereDate($column, '>=', $start);
        }

        if ($end) {
            $model->whereDate($column, '<=', $end);
        }

        return $model;
    }

    /**
     * Set the filter query.
     *
     * @return  array<string>
     */
    public function options(): array
    {
        return [];
    }
}

<?php

declare(strict_types=1);

namespace Daguilarm\LiveTables\Components\Filter;

use Daguilarm\LiveTables\Components\FilterComponent;
use Daguilarm\LiveTables\Facades\LiveTables;
use Illuminate\Database\Eloquent\Builder;

final class FilterByYear extends FilterComponent
{
    /**
     * Create a new field.
     */
    public function __construct(?string $uriKey = null)
    {
        parent::__construct($uriKey);

        // Set the view
        $this->view = LiveTables::include('sections.filters.year');
        // Set the unique key
        $this->uriKey = $uriKey ?? 'year';
    }

    /**
     * Set the filter query.
     *
     * @param int | float | string | null $value
     */
    public function apply(Builder $model, $value): Builder
    {
        return $model
            ->whereYear($this->getColumn($model), $value);
    }

    /**
     * Set the filter query.
     *
     * @return  array<string>
     */
    public function options(): array
    {
        return range(
            date('Y'),
            date('Y') - 10
        );
    }
}

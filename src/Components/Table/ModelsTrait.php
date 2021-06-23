<?php

declare(strict_types=1);

namespace Daguilarm\LiveTables\Components\Table;

use Daguilarm\LiveTables\Components\Table\Models\Search;
use Illuminate\Database\Eloquent\Builder;

trait ModelsTrait
{
    /**
     * Set the variables.
     */
    protected object $model;
    protected object $sqlBuilder;
    protected string $tableName;

    /**
     * Set the model builder.
     */
    public function models(): Builder
    {
        // Resolve the filters
        $this->resolveFilters();

        // Initialize the constructor
        $builder = $this->sqlBuilder;

        // Get the default sort attribute
        $sortAttribute = $this->getSortAttribute($builder);

        // Get the column.
        $column = $this->getColumnByAttribute($this->getSortField());

        // Initialize the search
        // @See Daguilarm\BelichTables\Components\Traits\Models\Search:class
        $search = new Search();

        // If the search is enabled, and the search input is not empty, then the search can start.
        $builder = $search->handle(
            builder: $builder,
            columns: $this->columns(),
            search: $this->search,
            showSearch: $this->options['search'],
        );

        // If the column is callable
        if ($column !== false && is_callable($column->getSortCallback())) {
            $search->callback(
                builder: $builder,
                column: $column,
                direction: $this->getSortDirection()
            );
        }

        // Sort by relationship [Daguilarm\BelichTables\Components\Traits\SortingRelatioships]
        if ($column->hasRealationship()) {
            [$builder, $sortAttribute] = $this->sortingByRelationship($builder, $column);
        }

        // Get the final result.
        return $builder->reorder($sortAttribute, $this->getSortDirection());
    }

    /**
     * Get current model class.
     */
    public function getModelClass(): string
    {
        return get_class(
            $this->models()->getModel()
        );
    }

    /**
     * Get current model instance.
     */
    public function getModel(): object
    {
        return app($this->getModelClass());
    }

    /**
     * Get current model instance.
     */
    public function getTableName(Builder $builder): string
    {
        return $builder->getQuery()->from;
    }

    /**
     * Set the sort attribute.
     */
    private function getSortAttribute(Builder $builder): string
    {
        return sprintf(
            '%s.%s',
            $this->getTableName($builder),
            $this->getSortField()
        );
    }
}

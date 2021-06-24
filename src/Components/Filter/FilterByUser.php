<?php

declare(strict_types=1);

namespace Daguilarm\LiveTables\Components\Filter;

use Daguilarm\LiveTables\Components\FilterComponent;
use Daguilarm\LiveTables\Facades\LiveTables;
use Illuminate\Database\Eloquent\Builder;

final class FilterByUser extends FilterComponent
{
    protected string $user_model = \App\Models\User::class;

    /**
     * Create a new field.
     */
    public function __construct(?string $uriKey = null)
    {
        parent::__construct($uriKey);

        // Set the view
        $this->view = LiveTables::include('sections.filters.user');
        // Set the default table column
        $this->tableColumn = 'id';
        // Set the unique key
        $this->uriKey = $uriKey ?? 'user';
    }

    /**
     * Set the filter query.
     *
     * @param int | float | string | null $value
     */
    public function apply(Builder $model, $value): Builder
    {
        return $model->where(
            $this->getColumn($model),
            $value,
        );
    }

    /**
     * Set the filter query.
     *
     * @return  array<string>
     */
    public function options(): array
    {
        return app($this->user_model)
            ->select('users.id', 'users.name')
            ->orderBy('name')
            ->pluck('name', 'id')
            ->toArray();
    }

    /**
     * Set User model class.
     */
    public function userClass(string $class): self
    {
        $this->user_model = $class;

        return $this;
    }
}

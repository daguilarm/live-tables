<?php

declare(strict_types=1);

namespace Daguilarm\LiveTables\Components\Table;

use Daguilarm\LiveTables\Components\Table\Relationships\RelationshipsSortsTrait;
use Daguilarm\LiveTables\Components\Table\Relationships\RelationshipsValueTrait;
use Daguilarm\LiveTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;

trait RelationshipsTrait
{
    use RelationshipsSortsTrait, RelationshipsValueTrait;

    /**
     * Set atribute.
     */
    public function attribute(Builder $query, string $relationships, string $attribute): string
    {
        // Set the default values
        [$baseQuery, $table] = $this->getDefaultValues($query);

        foreach (explode('.', $relationships) as $relationship) {

            // Default model
            $model = $baseQuery->getRelation($relationship);

            // Values base on the relationship type
            [$table, $foreign, $other, $baseQuery, $query] = match ($model) {
                // See the cases
                $model instanceof BelongsToMany => $this->getBelongsToMany($model, $baseQuery, $query),
                $model instanceof HasOneOrMany => $this->getHasOneOrMany($model, $baseQuery, $query),
                $model instanceof BelongsTo => $this->getBelongsTo($model, $baseQuery, $query),
                // Null relationship
                default => $this->getNullRelationship(),
            };

            // Null relationship
            if ($query === null) {
                return $attribute;
            }

            // Set the query values
            $query->leftJoin($table, $foreign, $other);
            $baseQuery = $model->getQuery();
        }

        return sprintf('%s.%s', $table, $attribute);
    }

    /**
     * Get the column attribute.
     */
    protected function getColumnByAttribute(string $attribute): Column | bool
    {
        foreach ($this->columns() as $column) {
            if ($column->getAttribute() === $attribute) {
                return $column;
            }
        }

        return $column ?? false;
    }

    /**
     * Get the default values.
     *
     * @return array<string>
     */
    private function getDefaultValues(Builder $query): array
    {
        return [$query, ''];
    }

    /**
     * Get the values for a BelongsToMany realtionship.
     *
     * @return array<string>
     */
    private function getBelongsToMany(BelongsToMany $model, Builder $baseQuery, Builder $query): array
    {
        // Get the pivot table
        $pivot = $model->getTable();
        // Query results
        $query->leftJoin(
            $pivot,
            $model->getExistenceCompareKey(),
            $model->getQualifiedParentKeyName(),
        );
        // Get the related values
        $related = $model->getRelated();
        $table = $related->getTable();
        $foreign = $pivot.'.'.$related->getForeignKey();
        $other = $related->getQualifiedKeyName();
        // Query results
        $baseQuery->addSelect($table.'.'.$attribute);
        $query->leftJoin($table, $foreign, $other);

        return [
            $table,
            $foreign,
            $other,
            $baseQuery,
            $query,
        ];
    }

    /**
     * Get the values for a HasOne or HasMany realtionship.
     *
     * @return array<string>
     */
    private function getHasOneOrMany(HasOneOrMany $model, Builder $baseQuery, Builder $query): array
    {
        return [
            $model->getRelated()->getTable(),
            $model->getQualifiedForeignKeyName(),
            $model->getQualifiedParentKeyName(),
            $baseQuery,
            $query,
        ];
    }

    /**
     * Get the values for a BelongsTo realtionship.
     *
     * @return array<string>
     */
    private function getBelongsTo(BelongsTo $model, Builder $baseQuery, Builder $query): array
    {
        return [
            $model->getRelated()->getTable(),
            $model->getQualifiedForeignKeyName(),
            $model->getQualifiedOwnerKeyName(),
            $baseQuery,
            $query,
        ];
    }

    /**
     * Get the values for a null realtionship.
     *
     * @return array<null>
     */
    private function getNullRelationship(): array
    {
        return [null, null, null, null, null];
    }
}

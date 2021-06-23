<?php

declare(strict_types=1);

namespace Daguilarm\LiveTables\Views;

use Daguilarm\LiveTables\Facades\LiveTables;

final class Action
{
    /**
     * Action column constructor.
     */
    public static function make(?string $view = null): Column
    {
        return Column::make('')
            ->render(static function ($model) use ($view) {
                // Get the view for the action or the default view
                $component = $view ?? self::defaultView();

                return view($component)
                    ->withId($model->id)
                    ->withResource($model->getTable());
            })
            ->excludeFromExport();
    }

    /**
     * Default action view.
     */
    private static function defaultView(): string
    {
        return sprintf('live-tables::%s.sections.actions.default', config('live-tables.theme'));
    }
}

<?php

declare(strict_types=1);

namespace Daguilarm\LiveTables\Components\Table;

trait OptionsTrait
{
    /**
     * Set the live table options.
     *
     * @param array<string> $options
     */
    protected array $options;

    /**
     * Update the table options.
     *
     * @return array<string>
     */
    public function mergeOptions(): array
    {
        if(isset($this->options)) {
            return collect($this->defaultOptions())
                ->mapWithKeys(function($value, $key) {
                    // If the current option is in the custom options from the user.
                    if(isset($this->options[$key])) {
                        return [$key => $this->options[$key]];
                    }
                    // Just keep it.
                    return [$key => $value];
                })
                ->toArray();
        }

        return $this->defaultOptions();
    }

    /**
     * Set the default table options.
     *
     * @return array<string>
     */
    public function defaultOptions(): array
    {
        return [
            // Default
            'loading' => true,
            'pagination' => true,
            'checkBoxesShow' => true,
            // Get the allowed formats and the selected one
            'exportOptions' => $this->exportAllowedFormats,
            'exportAs' => [],
            // Per page configuration
            'perPageOptions' => [10, 25, 50, 100, 300, 500],
            'perPage' => 25,
            // Search field
            'search' => true,
            'searchReset' => true,
            // Table options
            'tableAlternateBackground' => false,
            'tableAlternateBackgroundColor' => 'bg-gray-100',
            'tableRefresh' => false,
            'tableRefreshInSeconds' => 5,
            'tableHeadShow' => true,
            'tableFooterShow' => false,
            // Actions
            'actionCreate' => false,
            'actionCreateUrl' => '',
            'actionShow' => true,
            'actionUpdate' => true,
            'actionDelete' => false,
            // Columns
            'columnSortBy' => 'id',
            'columnSortDirection' => 'ASC',
        ];
    }
}

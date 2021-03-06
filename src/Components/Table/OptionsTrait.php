<?php

declare(strict_types=1);

namespace Daguilarm\LiveTables\Components\Table;

use Illuminate\Support\Str;

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
            'id' => Str::random(10),
            'loading' => true,
            'checkBoxesShow' => true,
            // Get the allowed formats and the selected one
            'exportOptions' => $this->exportAllowedFormats,
            'exportAs' => [],
            'exportFileName' => 'export-data',
            // Per page configuration
            'perPage' => 25,
            'perPageOptions' => [10, 25, 50, 100, 300, 500],
            'perPageShow' => true,
            // Search field
            'search' => true,
            'searchReset' => true,
            // Table options
            'tableRefresh' => false,
            'tableRefreshInSeconds' => 5,
            'tableHeadShow' => true,
            'tableFooterShow' => false,
            // Actions
            'actionCreateUrl' => '',
            // Columns
            'columnSortBy' => 'id',
            'columnSortDirection' => 'ASC',
            'columnHighlight' => 'bg-yellow-50 border-r border-l border-yellow-100',
            // Rows
            'rowAlternateBackground' => true,
            'rowBackgroundColor' => 'bg-white',
            'rowBackgroundColorAlternate' => 'bg-gray-50',
            // Pagination
            'paginationShow' => true,
        ];
    }
}

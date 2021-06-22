<?php

declare(strict_types=1);

namespace Daguilarm\LiveTables\Components;

use Daguilarm\LiveTables\Contracts\TableContract;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * Class TableComponent.
 */
abstract class TableComponent extends Component implements TableContract
{
    protected array $exportAllowedFormats = ['xml', 'xmls', 'csv', 'pdf'];

    /**
     * Delete listeners.
     *
     * @var array<string>
     */
    protected $listeners = ['itemDelete', 'fileDownloadNotification'];

    /**
     * Set the model instance.
     */
    protected object $model;

    /**
     * TableComponent constructor.
     */
    public function __construct(?string $id = null)
    {
        parent::__construct($id);

        // // Set the pagination theme
        // $this->paginationTheme = 'tailwind';

        // // Init the column's filter
        // $this->sqlBuilder = $this->query();

        // // Init the model
        // $this->model = $this->getModel();

        // // Get table name
        // $this->tableName = $this->model->getTable();
    }

    /**
     * Set the view.
     */
    public function viewName(?string $viewName = null): string
    {
        return $viewName ?? 'live-tables::table-components';
    }

    /**
     * Render the view in the blade template.
     */
    public function render(): View
    {
        return view($this->viewName(), [
            'options' => $this->mergeOptions(),
        ]);
    }

    /**
     * Update the table options.
     */
    public function mergeOptions()
    {
        if(isset($this->options)) {
            return collect($this->defaultOptions())
                ->mapWithKeys(function($value, $key) {
                    if(isset($this->options[$key])) {
                        return [$key => $this->options[$key]];
                    }
                    return [$key => $value];
                })
                ->toArray();
        }

        return $this->defaultOptions();
    }

    /**
     * Set the table options.
     */
    public function defaultOptions()
    {
        return [
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

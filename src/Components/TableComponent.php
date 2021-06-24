<?php

declare(strict_types=1);

namespace Daguilarm\LiveTables\Components;

use Daguilarm\LiveTables\Components\Filter\FiltersTrait;
use Daguilarm\LiveTables\Components\Table\CheckboxesTrait;
use Daguilarm\LiveTables\Components\Table\DeletesTrait;
use Daguilarm\LiveTables\Components\Table\ExportsTrait;
use Daguilarm\LiveTables\Components\Table\ModelsTrait;
use Daguilarm\LiveTables\Components\Table\OperationsTrait;
use Daguilarm\LiveTables\Components\Table\OptionsTrait;
use Daguilarm\LiveTables\Components\Table\RelationshipsTrait;
use Daguilarm\LiveTables\Components\Table\RequestsTrait;
use Daguilarm\LiveTables\Components\Table\SearchsTrait;
use Daguilarm\LiveTables\Components\Table\SortsTrait;
use Daguilarm\LiveTables\Contracts\TableContract;
use Daguilarm\LiveTables\Facades\LiveTables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * Class TableComponent.
 */
abstract class TableComponent extends Component implements TableContract
{
    use CheckboxesTrait,
        DeletesTrait,
        ExportsTrait,
        FiltersTrait,
        ModelsTrait,
        OperationsTrait,
        OptionsTrait,
        RelationshipsTrait,
        RequestsTrait,
        SearchsTrait,
        SortsTrait,
        WithPagination;

    /**
     * Listeners.
     *
     * @var array<string>
     */
    protected $listeners = ['itemDelete', 'fileDownloadNotification'];

    /**
     * TableComponent constructor.
     */
    public function __construct(?string $id = null)
    {
        parent::__construct($id);

        // Set the live table options
        $this->options = $this->mergeOptions();

        // Init the column's filter
        $this->sqlBuilder = $this->query();

        // Init the model
        $this->model = $this->getModel();

        // Get table name
        $this->tableName = $this->model->getTable();

        // Sorting columns
        $this->sortField = $this->options['columnSortBy'];
        $this->sortDirection = $this->options['columnSortDirection'];
    }

    /**
     * Set the view.
     */
    public function viewName(?string $path = null): string
    {
        return $path ?? LiveTables::include('table');
    }

    /**
     * Render the view in the blade template.
     */
    public function render(): View
    {
        return view($this->viewName(), [
            'columns' => $this->columns(),
            'filters' => $this->filters(),
            'models' => $this->options['paginationShow']
                ? $this->models()->paginate((int) $this->options['perPage'])
                : $this->models()->get(),
            'options' => $this->options,
        ]);
    }

    /**
     * Set the default filters.
     *
     * @return  array<string>
     */
    public function filters(): array
    {
        return [];
    }
}

<?php

declare(strict_types=1);

namespace Daguilarm\LiveTables\Components;

use Daguilarm\LiveTables\Components\Table\CheckboxesTrait;
use Daguilarm\LiveTables\Components\Table\DeletesTrait;
use Daguilarm\LiveTables\Components\Table\FiltersTrait;
use Daguilarm\LiveTables\Components\Table\ExportsTrait;
use Daguilarm\LiveTables\Components\Table\ModelsTrait;
use Daguilarm\LiveTables\Components\Table\OptionsTrait;
use Daguilarm\LiveTables\Components\Table\SortsTrait;
use Daguilarm\LiveTables\Contracts\TableContract;
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
        OptionsTrait,
        SortsTrait;

    /**
     * Listeners.
     *
     * @var array<string>
     */
    protected $listeners = ['itemDelete', 'fileDownloadNotification'];

    /**
     * Variables.
     */
    protected string $paginationTheme;
    protected Builder $sqlBuilder;
    protected string $tableName;

    /**
     * TableComponent constructor.
     */
    public function __construct(?string $id = null)
    {
        parent::__construct($id);

        // Set the live table options
        $this->options = $this->mergeOptions();

        // Set the pagination theme
        $this->paginationTheme = 'tailwind';

        // // Init the column's filter
        $this->sqlBuilder = $this->query();

        // // Init the model
        $this->model = $this->getModel();

        // // Get table name
        $this->tableName = $this->model->getTable();
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
            'options' => $this->options(),
        ]);
    }
}

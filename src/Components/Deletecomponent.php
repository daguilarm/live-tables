<?php

declare(strict_types=1);

namespace Daguilarm\LiveTables\Components;

use Daguilarm\LiveTables\Facades\LiveTables;
use Livewire\Component;

/**
 * Class TableComponent.
 */
final class DeleteComponent extends Component
{
    public string $userId;

    /**
     * Render component.
     *
     * @return  Illuminate\View\View
     */
    public function render()
    {
        return view(LiveTables::include('components.delete-button'));
    }

    /**
     * Delete elements from ID or List of IDs.
     */
    public function itemDelete(?string $id = null): void
    {
        $this->emit('itemDelete', $id);
    }
}

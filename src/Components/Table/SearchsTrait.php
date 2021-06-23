<?php

declare(strict_types=1);

namespace Daguilarm\LiveTables\Components\Table;

trait SearchsTrait
{
    /**
     * The initial search string.
     */
    public string $search = '';

    /**
     * Resets the search string.
     */
    public function clearSearch(): void
    {
        $this->search = '';
    }
}

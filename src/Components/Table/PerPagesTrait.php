<?php

declare(strict_types=1);

namespace Daguilarm\LiveTables\Components\Table;

trait PerPagesTrait
{
    /**
     * Default variables.
     */
    public int $perPage;

    public function changePerPage(int $value)
    {
        session()->put('perPage', $value);

        $this->perPage = $value;
    }
}

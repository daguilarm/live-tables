<?php

declare(strict_types=1);

namespace Daguilarm\LiveTables\Components\Table;

trait RequestsTrait
{
    /**
     * Delete an element base on its ID.
     */
    public function requestUser(): object
    {
        // Just for testing the package
        if (app()->environment() === 'testing') {
            return \Daguilarm\LiveTables\Tests\App\Models\User::find(1);
        }

        // The regular way
        return request()->user();
    }
}

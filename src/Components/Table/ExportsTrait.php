<?php

declare(strict_types=1);

namespace Daguilarm\LiveTables\Components\Table;

trait ExportsTrait
{
    /**
     * Set the export allowed formats.
     *
     * @param array<string> $exportAllowedFormats
     */
    protected array $exportAllowedFormats = ['xml', 'xmls', 'csv', 'pdf'];
}

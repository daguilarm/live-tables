# Installation

You can install the package via composer:

```bash
composer require daguilarm/live-tables
```

or if you want to test...

```bash
"daguilarm/live-tables": "@dev"
```

Publishing assets is mandatory for this package:

```bash
php artisan vendor:publish --provider="Daguilarm\LiveTables\LiveTablesServiceProvider"
```

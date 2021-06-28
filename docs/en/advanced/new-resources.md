# Create new resources

As commented on [Attributes](en/basics/attributes.md), there is a way to add a  *add-new-resource-button* to the model shown in the table. This button looks like this (at the top right of the image):

![live-tables](../../_media/new-resource.png ':class=thumbnail')

To activate it, we will only have to go to our *Table Component*, and add the attribute `actionCreateUrl` with the url path or a route:

```php 
<?php

namespace App\Http\Livewire;

use App\Models\Question;
use Daguilarm\LiveTables\Components\TableComponent;
use Daguilarm\LiveTables\Views\Action;
use Daguilarm\LiveTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use Str;

class QuestionsTable extends TableComponent
{
    public array $options = [
        'actionCreateUrl' => '/path/to/url',
    ];
}
```

The button will only be activated (and visible), if there is a url associated to the attribute `actionCreateUrl`, if you keep this empty nothing will be visible.

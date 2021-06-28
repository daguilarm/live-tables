# Attributes

The attributes that you can use in a **Table Component** are described below. These attributes have been classified by groups, in order to facilitate their management.

This attributes will let you customize your **Live Table** as you need. You can customize the attributes from the components, using the `$option` variable:

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
        'id' => 'myID',
        'loading' => true,
        'checkBoxesShow' => true,
        'perPage' => 25,
        'perPageOptions' => [10, 25, 50, 100, 300, 500],
        'perPageShow' => true,
    ];
}
```

## Export attributes

| Attribute | Default | Description |
| :---------- |:------------ |:------------| :-----------| 
| exportOptions | [] | Defines the file formats that are allowed to be downloaded. If you leave it in blank, the export option will be canceled. |
| exportFileName | export-data | Defines the file name for the exported file. |

## Table attributes

| Attribute | Default | Description |
| :---------- |:------------ |:------------| :-----------| 
| id | random | Defines the table ID value. |
| tableRefresh | false | Defines if the table will be refreshing at a certain interval of time. |
| tableRefreshInSeconds | 5 seconds | Defines the interval of time, in seconds, for table refresh. |
| checkBoxesShow | true | Show or hide the checkboxes fields in the table. |
| loading | true | Show or hide the loading indicador after each change. |
| tableHeadShow | true | Show or hide the table head. |
| tableFooterShow | false | Show or hide the table footer. |

## Pagination attributes

| Attribute | Default | Description |
| :---------- |:------------ |:------------| :-----------| 
| perPageShow | true | show or hide the pagination. |

## Per page attributes

| Attribute | Default | Description |
| :---------- |:------------ |:------------| :-----------| 
| perPageShow | true | Show the selector with the per page options. |
| perPageOptions | 10, 25, 50, 100 | Define the interval of values for the attribute. |
| perPage | 25 | Set the current value for the attribute. |

## Search attributes

| Attribute | Default | Description |
| :---------- |:------------ |:------------| :-----------| 
| search | true | Show or hide the search box. |
| searchReset | true | Show or hide a button to clear the search box. |

## Column attributes

| Attribute | Default | Description |
| :---------- |:------------ |:------------| :-----------| 
| columnSortBy | id | The default sort field for the table. |
| columnSortDirection | asc | The default sort direction for the table. |
| columnHighlight | bg-yellow-50 border-r border-l border-yellow-100 | Highlight a column that has been filtered. It is just a method to know what filters have been applied.|

## Row attributes

| Attribute | Default | Description |
| :---------- |:------------ |:------------| :-----------| 
| rowAlternateBackground | true | Add zebra striping to the table (striped rows). |
| rowBackgroundColor | bg-white | Default background color or odd color when applied. |
| rowBackgroundColorAlternate | bg-gray-50 | Even color when applied.|

## Other attributes

| Attribute | Default | Description |
| :---------- |:------------ |:------------| :-----------| 
| actionCreateUrl | disabled | Set the url path for create a new resource. For example: `../../dashboard/users/create` |

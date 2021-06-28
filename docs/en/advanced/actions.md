# Actions

With the actions, we will be able to perform the operations of: **show**, **edit** and **delete**. **Live Tables** automatically enables and configure the action of **delete**, and prepare the actions of **show** and **edit**. When you define the actions, the icons for **show**, **edit** and **delete**, appear as shown below:

![live-tables](../../_media/actions.jpg ':class=thumbnail')

Below is an example of how to activate the actions:

```php
public function columns() : array
{
    return [
        Column::make('ID'),
        Column::make('Name'),
        Action::make(),
    ];
}
```

As you can see, it is only necessary to add `Action::make()` in the **Table Component**. Additionally, a parameter can be added to the `make()` method, this parameter allow us to add the location of our custom **Blade** file with the actions.

```php
public function columns() : array
{
    return [
        Column::make('ID'),
        Column::make('Name'),
        Action::make('path.to.actions'),
    ];
}
```

By default, the predetermine action is automatically loaded. 
Below is the code for the default **Blade** view:

```html 
<div class="flex justify-end text-gray-400" >
    <!-- Show button -->
    @can('view', $model)
        <a
            href="{{ sprintf('%s/%s', $model->getTable(), $model->id) }}"
            class="py-2 px-1 hover:text-green-600"
            dusk="view-button-{{ $model->id }}"
        >
            <!-- icon: heroicon-o-eye -->
            <svg class="h-6 xl:h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
            </svg>
        </a>
    @endcan

    <!-- Edit button -->
    @can('edit', $model)
        <a
            href="{{ sprintf('%s/%s', $model->getTable(), $model->id) }}/edit"
            class="py-2 px-1 hover:text-blue-600"
            dusk="edit-button-{{ $model->id }}"
        >
            <!-- icon: heroicon-o-pencil-alt -->
            <svg class="h-6 xl:h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
        </a>
    @endcan

    <!-- Delete button -->
    @can('delete', $model)
        <a
            class="py-2 px-1 text-gray-300 hover:text-gray-600"
            href="#"
        >
            {{-- icon: heroicon-o-trash --}}
            <svg class="h-6 xl:h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
            </svg>
        </a>
    @endcan
</div>
```

You can find the folder actions in `resources/views/vendor/live-tables/tailwind/actions/`.


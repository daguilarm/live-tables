{{-- Include the table body --}}
<tbody>
    {{-- If there is no results from the database --}}
    @if($models->isEmpty())
        <tr>
            {{-- Create the colspan base on the columns and if the checkbox is enable --}}
            <td
                colspan="{{ collect($columns)->count() + ($options['checkBoxesShow'] ? 1 : 0) }}"
                class="text-center p-6 bg-gradient-to-b from-white via-white to-gray-200"
            >
                {{-- Text for no results --}}
                @lang('belich-tables::strings.no_results')
            </td>
        </tr>

    {{-- If there is results... return the data! --}}
    @else
        {{-- Get the table rows --}}
        @foreach($models as $model)
            <tr
                class="{{ LiveTables::rowBackgroundColor($loop, $options) }} border-b border-gray-150"
                id="row_id_{{ $model->id }}"
                dusk="row-id-{{ $model->id }}"
            >
                {{-- Table checkbox --}}
                @if($options['checkBoxesShow'])
                    <td class="p-1 xl:p-3">
                        <input
                            type="checkbox"
                            wire:model="checkboxValues"
                            value="{{ $model->id }}"
                            class="shadow opacity-75 __checkboxes"
                            dusk="table-index-checkbox-{{ $model->id }}"
                        >
                    </td>
                @endif

                {{-- Table columns --}}
                @foreach($columns as $column)
                    @if ($column->isVisible())
                        <td
                            class="{{ $column->getVisibility() }} {{ LiveTables::columnHighlight($column->getAttribute(), $filterColumns, $options) }} px-6 py-3 text-sm text-gray-500"
                            dusk="column-{{ $column->getAttribute() }}-{{ $model->id }}"
                        >
                            {{-- Render column as Boolean --}}
                            @if ($column->isBoolean())
                                {{-- Render green --}}
                                @if ($column->resolveColumn($column, $model) === true)
                                    <div class="h-4 w-4 rounded-full bg-green-400" dusk="boolean-on-{{ $model->id }}"></div>
                                {{-- Render gray --}}
                                @else
                                    <div class="h-4 w-4 rounded-full bg-gray-200" dusk="boolean-off-{{ $model->id }}"></div>
                                @endif
                            {{-- Render column as HTML --}}
                            @elseif ($column->isHtml())
                                {!! $column->resolveColumn($column, $model) !!}

                            {{-- Render column --}}
                            @else
                                {{ $column->resolveColumn($column, $model) }}
                            @endif
                        </td>
                    @endif
                @endforeach
            </tr>
        @endforeach
    @endif
</tbody>

{{-- Include the table body --}}
<tbody>
    {{-- If there is no results from the database --}}
    @if($results->isEmpty())
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
        @foreach($results as $result)
            <tr
                class="{{ LiveTables::rowBackgroundColor($loop, $options) }} border-b border-gray-150"
                id="row_id_{{ $result->id }}"
                dusk="row-id-{{ $result->id }}"
            >
                {{-- Table checkbox --}}
                @if($options['checkBoxesShow'])
                    <td class="p-1 xl:p-3">
                        <input
                            type="checkbox"
                            wire:model="checkboxValues"
                            value="{{ $result->id }}"
                            class="shadow opacity-75 __checkboxes"
                            dusk="table-index-checkbox-{{ $result->id }}"
                        >
                    </td>
                @endif

                {{-- Table columns --}}
                @foreach($columns as $column)
                    {{-- If the column is visible --}}
                    @if ($column->isVisible())
                        <td
                            class="{{ $column->getVisibility() }} {{ LiveTables::columnHighlight($column->getAttribute(), $filterColumns, $options) }} px-6 py-3 text-sm text-gray-500"
                            dusk="column-{{ $column->getAttribute() }}-{{ $result->id }}"
                        >
                            {{-- Render column as Boolean --}}
                            @if ($column->isBoolean())
                                {{-- Render green --}}
                                @if ($column->resolveColumn($column, $result) === true)
                                    <div class="h-4 w-4 rounded-full bg-green-400" dusk="boolean-on-{{ $result->id }}"></div>
                                {{-- Render gray --}}
                                @else
                                    <div class="h-4 w-4 rounded-full bg-gray-200" dusk="boolean-off-{{ $result->id }}"></div>
                                @endif
                            {{-- Render column as HTML --}}
                            @elseif ($column->isHtml())
                                {!! $column->resolveColumn($column, $result) !!}

                            {{-- Render column --}}
                            @else
                                {{ $column->resolveColumn($column, $result) }}
                            @endif
                        </td>
                    @endif
                @endforeach
            </tr>
        @endforeach
    @endif
</tbody>

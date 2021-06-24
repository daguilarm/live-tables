<div class="pb-3 flex items-center justify-between">

    {{-- Left container: search and filters --}}
    <div class="flex mt-3">
        <div class="flex rounded-md">
            <div class="relative flex-grow">
                {{-- Seach --}}
                @includeWhen(
                    $options['search'],
                    LiveTables::include('sections.search')
                )
            </div>
        </div>

        {{-- Add all the filters --}}
        @includeWhen(
            isset($filters) && count($filters) > 0,
            LiveTables::include('sections.filters')
        )
    </div>

    {{-- Right container: search and filters --}}
    <div class="flex">
        {{-- Add perpage selector --}}
        @includeWhen(
            $options['perPageShow'],
            LiveTables::include('sections.perPage')
        )

        {{-- Add new resource button --}}
        @includeWhen(
            $options['actionCreateUrl'],
            LiveTables::include('sections.new-resource')
        )

        {{-- Add export button --}}
        @includeWhen(
            $options['exportAs'] && $checkboxValues,
            LiveTables::include('sections.export')
        )

        {{-- Add mass delete button (only if there is checkboxes checked) --}}
        @includeWhen(
            $checkboxValues,
            LiveTables::include('sections.bulk-delete')
        )
    </div>

</div>

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

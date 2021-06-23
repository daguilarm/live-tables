<div id="belich-tables" dusk="belich_tables">

    <div class="flex flex-col">

        {{-- Include messages --}}
        {{-- @includeWhen(
            session()->has('message'),
            LiveTables::include('components.flash-message')
        ) --}}

        {{-- Include the table loading view --}}
        {{-- @includeWhen(
            $tableOptions->get('loading'),
            LiveTables::include('sections.loading')
        ) --}}

        <div class="py-2 align-middle inline-block sm:px-6 lg:px-8">
            <div class="border-b border-gray-200 sm:rounded-lg">
                {{-- Load all the options: search, filters, perPage, export, new resource... --}}
                {{-- @include(LiveTables::include('sections.options')) --}}

                <div class="bg-gray-50 text-gray-500 border border-gray-200 rounded-t-lg rounded-b-lg">
                    <table
                        class="table-auto w-full mt-1"
                        {{-- Refresh the table  --}}
                        @if ($options['tableRefresh'])
                            @if ($options['tableRefreshInSeconds'])
                                wire:poll.{{ $options['tableRefreshInSeconds'] * 1000 }}ms
                            @else
                                wire:poll
                            @endif
                        @endif
                    >

                        {{-- Include the table head --}}
{{--                         @includeWhen(
                            data_get($tableOptions, 'table.head'),
                            LiveTables::include('sections.thead')
                        ) --}}

                        {{-- Include the table data --}}
                        <tbody>
                            {{-- @if($models->isEmpty())
                                @include(LiveTables::include('sections.empty'))
                            @else
                                @include(LiveTables::include('sections.data'))
                            @endif --}}
                        </tbody>

                        {{-- Include the table foot --}}
                        @includeWhen(
                            $options['tableFooterShow'],
                            LiveTables::include('sections.footer')
                        )
                    </table>

                    {{-- Include the pagination --}}
                    {{-- @if($options['paginationShow'])
                        {{ $models->links(LiveTables::include('sections.pagination')) }}
                    @endif --}}
                </div>
            </div>
        </div>
    </div>

    {{-- Javascript if needed --}}
    <script>
        @stack('live-tables-javascript')
    </script>

</div>


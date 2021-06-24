<div id="belich-tables" dusk="belich_tables">

    <div class="flex flex-col">

        {{-- Include messages --}}
        @includeWhen(
            session()->has('message'),
            LiveTables::include('components.flash-message')
        )

        {{-- Include the table loading state --}}
        @if($options['loading'])
            <div
                wire:loading
                class="pulse pulse-vertical-align"
            >
                <div dusk="belich-tables-loading">
                    <div class="double-bounce1"></div>
                    <div class="double-bounce2"></div>
                </div>
            </div>
        @endif

        <div class="py-2 align-middle inline-block sm:px-6 lg:px-8">
            <div class="border-b border-gray-200 sm:rounded-lg">

                {{-- Load all the sections: search, filters, perPage, export, new resource... --}}
                @include(LiveTables::include('sections'))

                <div class="mt-2 bg-gray-50 text-gray-500 border border-gray-200 rounded-t-lg rounded-b-lg">
                    <table
                        class="table-auto w-full"
                        id="{{ $options['id'] }}"

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
                        @includeWhen(
                            $options['tableHeadShow'],
                            LiveTables::include('table.head')
                        )

                        {{-- Include the table data --}}
                        <tbody>
                            @include(LiveTables::include('table.body'))
                        </tbody>

                        {{-- Include the table foot --}}
                        @includeWhen(
                            $options['tableFooterShow'],
                            LiveTables::include('table.footer')
                        )
                    </table>

                    {{-- Include the pagination --}}
                    @if($options['paginationShow'])
                        {{ $models->links(LiveTables::include('table.pagination')) }}
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Javascript if needed --}}
    <script>
        @stack('live-tables-javascript')
    </script>

</div>


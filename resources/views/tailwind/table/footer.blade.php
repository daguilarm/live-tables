<tfoot class="bg-gray-400">
    <tr>
        {{-- Adjust for checkboxes --}}
        @if($options['checkBoxesShow'])
            <td class="px-6 py-3"></td>
        @endif

        {{-- All the columns --}}
        @foreach($columns as $column)
            <td class="px-6 py-3 text-left text-white"></td>
        @endforeach
    </tr>
</tfoot>

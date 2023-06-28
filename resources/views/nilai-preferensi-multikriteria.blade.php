<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Index Preferensi Multikriteria') }}
        </h2>
    </x-slot>

    <main class="px-5 bg-white min-h-screen">
        <table>
            <thead>
                <tr>
                    <th></th>
                    @foreach ($nilaiPreferensiMultikriteria as $row)
                        <th class="px-6 py-4 border">{{ chr(65 + $loop->index) }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($nilaiPreferensiMultikriteria as $row)
                    <tr>
                        <th class="px-6 py-4 border">{{ chr(65 + $loop->index) }}</th>
                        @foreach ($row as $value)
                            <td class="px-6 py-4 whitespace-nowrap border">{{ $value }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- <table class="border w-full">
            <thead>
                <tr>
                    <th></th>
                    @foreach ($nilaiPreferensiMultikriteria as $key => $values)
                        <th class="px-6 py-4 border">{{ $key }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($nilaiPreferensiMultikriteria as $rowKey => $rowValues)
                    <tr>
                        <th class="border">{{ $rowKey }}</th>
                        @foreach ($nilaiPreferensiMultikriteria as $columnKey => $columnValues)
                            @if (isset($rowValues["$rowKey,$columnKey"]))
                                <td class="border px-6 py-4 whitespace-nowrap text-center">
                                    {{ $rowValues["$rowKey,$columnKey"] }}
                                </td>
                            @else
                                <td class="px-6 py-4 bg-black/20"></td>
                            @endif
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table> --}}
    </main>
</x-app-layout>

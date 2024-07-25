<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Perhitungan Leaving Flow, Entering Flow, dan Net Flow') }}
        </h2>
    </x-slot>

    <main class="px-5 bg-white min-h-screen overflow-auto">
        <x-table :title="'Index Preferensi Multi Kriteria'" :titleColspan="4">
            <tr>
                <th class="border"></th>
                @foreach ($nilaiPreferensiMultikriteria as $row)
                    <th class="px-6 py-4 border">{{ chr(65 + $loop->index) }}</th>
                @endforeach
            </tr>
            @foreach ($nilaiPreferensiMultikriteria as $row)
                <tr>
                    <th class="px-6 py-4 border">{{ chr(65 + $loop->index) }}</th>
                    @foreach ($row as $value)
                        <td
                            class="px-6 py-4 whitespace-nowrap text-center border {{ is_null($value) ? 'bg-black/30' : 'bg-transparent' }}">
                            {{ $value }}</td>
                    @endforeach
                </tr>
            @endforeach
        </x-table>

        <section class="grid grid-cols-3 gap-3 mt-5">
            <x-table :title="'Leaving Flow'" :titleColspan="2">
                @foreach ($leavingFlow as $index => $lfValue)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-center border">A{{ $loop->index + 1 }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center border">{{ $lfValue }}</td>
                    </tr>
                @endforeach
            </x-table>

            <x-table :title="'Entering Flow'" :titleColspan="2">
                @foreach ($enteringFlow as $index => $efValue)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-center border">A{{ $loop->index + 1 }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center border">{{ $efValue }}</td>
                    </tr>
                @endforeach
            </x-table>

            <x-table :title="'Net Flow'" :titleColspan="2">
                @foreach ($netFlow as $index => $nfValue)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-center border">A{{ $loop->index + 1 }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center border">{{ $nfValue }}</td>
                    </tr>
                @endforeach
            </x-table>
        </section>
    </main>
</x-app-layout>

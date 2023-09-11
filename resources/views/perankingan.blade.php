<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hasil Perhitungan') }}
        </h2>
    </x-slot>

    <main class="px-5 bg-white min-h-screen">
        <x-table :title="'Hasil Perankingan'" :headers="['Nama', 'Leaving Flow', 'Entering Flow', 'Net Flow', 'Ranking', 'Rekomendasi']" :titleColspan="6">
            @foreach ($hasilPerankingan as $index => $alternatif)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-center border">{{ $alternatif['nama'] }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center border">{{ $alternatif['leavingFlow'] }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center border">{{ $alternatif['enteringFlow'] }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center border">{{ $alternatif['netFlow'] }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center border">{{ $loop->index + 1 }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center border">
                        @if ($index < $loop->count / 3)
                            <span class="py-1 px-2 text-sm font-semibold text-white rounded-md bg-black">
                                Atlet Utama
                            </span>
                        @elseif ($index < (2 * $loop->count) / 3)
                            <span class="py-1 px-2 text-sm font-semibold text-white rounded-md bg-green-500">
                                Atlet Binaan
                            </span>
                        @else
                            <span class="py-1 px-2 text-sm font-semibold text-white rounded-md bg-blue-500">
                                Atlet Pemula
                            </span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </x-table>
    </main>
</x-app-layout>

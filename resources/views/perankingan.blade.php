<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Perankingan') }}
        </h2>
    </x-slot>

    <main class="px-5 bg-white min-h-screen">
        <x-table :title="'Hasil Perankingan'" :headers="['Nama', 'Leaving Flow', 'Entering Flow', 'Net Flow', 'Ranking']" :titleColspan="5">
            @foreach ($hasilPerankingan as $atlet)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-center border">{{ $atlet['nama'] }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center border">{{ $atlet['leavingFlow'] }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center border">{{ $atlet['enteringFlow'] }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center border">{{ $atlet['netFlow'] }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center border">{{ $loop->index + 1 }}</td>
                </tr>
            @endforeach
        </x-table>
    </main>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nilai Preferensi Kriteria') }}
        </h2>
    </x-slot>

    <main class="px-5 bg-white min-h-screen">
        <h1 class="font-bold uppercase text-xl text-center mb-5">Data Atlet Awal</h1>
        <x-table :headers="['Nama', '', 'Umur', 'Otot Kaki', 'Otot Lengan', 'Teknik', 'Prestasi']" class="mb-10">
            <tr>
                <td class="px-6 py-4 whitespace-nowrap"></td>
                <td class="px-6 py-4 whitespace-nowrap font-bold"></td>
                <td class="px-6 py-4 whitespace-nowrap font-bold">K1</td>
                <td class="px-6 py-4 whitespace-nowrap font-bold">K2</td>
                <td class="px-6 py-4 whitespace-nowrap font-bold">K3</td>
                <td class="px-6 py-4 whitespace-nowrap font-bold">K4</td>
                <td class="px-6 py-4 whitespace-nowrap font-bold">K5</td>
            </tr>
            @php
                $counter = 65; // Kode ASCII untuk huruf 'A'
            @endphp
            @foreach ($dataAtlet as $atlet)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $atlet->nama }}</td>
                    <td class="px-6 py-4 whitespace-nowrap font-bold">{{ chr($counter++) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $atlet->umur }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $atlet->otot_kaki }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $atlet->otot_lengan }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $atlet->teknik }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $atlet->prestasi }}</td>
                </tr>
            @endforeach
        </x-table>

        @foreach ($nilaiPreferensiKriteria as $prefix => $group)
            <x-table :headers="['']" class="mb-10">
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap"></td>
                    <td class="px-6 py-4 whitespace-nowrap font-bold">K1</td>
                    <td class="px-6 py-4 whitespace-nowrap font-bold text-green-500">H(d)</td>
                    <td class="px-6 py-4 whitespace-nowrap font-bold">K2</td>
                    <td class="px-6 py-4 whitespace-nowrap font-bold text-green-500">H(d)</td>
                    <td class="px-6 py-4 whitespace-nowrap font-bold">K3</td>
                    <td class="px-6 py-4 whitespace-nowrap font-bold text-green-500">H(d)</td>
                    <td class="px-6 py-4 whitespace-nowrap font-bold">K4</td>
                    <td class="px-6 py-4 whitespace-nowrap font-bold text-green-500">H(d)</td>
                    <td class="px-6 py-4 whitespace-nowrap font-bold">K5</td>
                    <td class="px-6 py-4 whitespace-nowrap font-bold text-green-500">H(d)</td>
                </tr>

                @foreach ($group as $key => $value)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-bold">{{ $key }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $value['K1']['nilai'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-green-500 font-semibold">
                            {{ $value['K1']['H(d)'] }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $value['K2']['nilai'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-green-500 font-semibold">
                            {{ $value['K2']['H(d)'] }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $value['K3']['nilai'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-green-500 font-semibold">
                            {{ $value['K3']['H(d)'] }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $value['K4']['nilai'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-green-500 font-semibold">
                            {{ $value['K4']['H(d)'] }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $value['K5']['nilai'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-green-500 font-semibold">
                            {{ $value['K5']['H(d)'] }}
                        </td>
                    </tr>
                @endforeach
            </x-table>
        @endforeach
    </main>
</x-app-layout>

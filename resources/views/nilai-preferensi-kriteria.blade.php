<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nilai Preferensi Kriteria') }}
        </h2>
    </x-slot>

    <main class="p-5 bg-white min-h-screen">
        <x-table :title="'Data Atlet Awal'" titleColspan="7" class="mb-10">
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-center border"></td>
                <td class="px-6 py-4 whitespace-nowrap text-center border font-bold"></td>
                @foreach ($dataKriteria as $kriteria)
                    <td class="px-6 py-4 whitespace-nowrap text-center border font-bold">{{ $kriteria->nama }}</td>
                @endforeach
            </tr>
            @php
                $counter = 65; // Kode ASCII untuk huruf 'A'
            @endphp
            @foreach ($dataAtlet as $atlet)
                {{-- {{ dd($atlet) }} --}}
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-center border">{{ $atlet->nama }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center border font-bold">{{ chr($counter++) }}</td>
                    @foreach ($atlet['data'] as $key => $value)
                        <td class="px-6 py-4 whitespace-nowrap text-center border">{{ $value }}</td>
                    @endforeach
                </tr>
                {{-- <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-center border">{{ $atlet->nama }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center border font-bold">{{ chr($counter++) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center border">{{ $atlet->umur }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center border">{{ $atlet->otot_kaki }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center border">{{ $atlet->otot_lengan }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center border">{{ $atlet->teknik }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center border">{{ $atlet->prestasi }}</td>
                </tr> --}}
            @endforeach
        </x-table>

        @foreach ($nilaiPreferensiKriteria as $prefix => $group)
            <x-table :title="$prefix" :titleColspan="11" class="mb-10">
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-center border"></td>
                    @foreach ($dataKriteria as $kriteria)
                        <td class="px-6 py-4 whitespace-nowrap text-center border font-bold">K{{ $loop->iteration }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center border font-bold text-green-500">H(d)</td>
                    @endforeach

                    {{-- <td class="px-6 py-4 whitespace-nowrap text-center border font-bold">K2</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center border font-bold text-green-500">H(d)</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center border font-bold">K3</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center border font-bold text-green-500">H(d)</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center border font-bold">K4</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center border font-bold text-green-500">H(d)</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center border font-bold">K5</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center border font-bold text-green-500">H(d)</td> --}}
                </tr>
                {{-- {{ dd($group) }} --}}
                @foreach ($group as $key => $value)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-center border font-bold">{{ $key }}</td>
                        @foreach ($value as $kriteriaKey => $kriteriaValue)
                            <td class="px-6 py-4 whitespace-nowrap text-center border">{{ $kriteriaValue['nilai'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center border text-green-500 font-semibold">
                                {{ $kriteriaValue['H(d)'] }}
                            </td>
                        @endforeach
                    </tr>
                @endforeach

                {{-- @foreach ($group as $key => $value)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-center border font-bold">{{ $key }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center border">{{ $value['K1']['nilai'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center border text-green-500 font-semibold">
                            {{ $value['K1']['H(d)'] }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center border">{{ $value['K2']['nilai'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center border text-green-500 font-semibold">
                            {{ $value['K2']['H(d)'] }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center border">{{ $value['K3']['nilai'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center border text-green-500 font-semibold">
                            {{ $value['K3']['H(d)'] }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center border">{{ $value['K4']['nilai'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center border text-green-500 font-semibold">
                            {{ $value['K4']['H(d)'] }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center border">{{ $value['K5']['nilai'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center border text-green-500 font-semibold">
                            {{ $value['K5']['H(d)'] }}
                        </td>
                    </tr>
                @endforeach --}}
            </x-table>
        @endforeach
    </main>
</x-app-layout>

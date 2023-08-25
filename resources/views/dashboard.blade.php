<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    <div class="py-5 grid grid-cols-3 gap-5 p-5">
        <div class="bg-white rounded-md p-3 border-l-4 border-green-500">
            <h1 class="font-bold text-xl">Kriteria</h1>
            <p class="font-light">{{ $jumlahKriteria }} data</p>
        </div>
        <div class="bg-white rounded-md p-3 border-l-4 border-green-500">
            <h1 class="font-bold text-xl">Subkriteria</h1>
            <p class="font-light">{{ $jumlahSubkriteria }} data</p>
        </div>
        <div class="bg-white rounded-md p-3 border-l-4 border-green-500">
            <h1 class="font-bold text-xl">Alternatif</h1>
            <p class="font-light">{{ $jumlahAlternatif }} data</p>
        </div>
    </div>
</x-app-layout>

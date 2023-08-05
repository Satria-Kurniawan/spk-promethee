<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Subkriteria') }}
        </h2>
    </x-slot>

    <main class="px-5 bg-white min-h-screen">
        <div class="p-5 border rounded-md">
            <h1 class="font-semibold text-xl uppercase mb-5">Tambah Data alternatif</h1>
            <form method="POST" action="{{ route('atlet.add') }}" class="flex flex-col gap-y-3">
                @csrf
                <section>
                    <x-input-label for="nama" :value="__('Nama Atlet')" />
                    <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama"
                        placeholder="Masukan nama atlet..." :value="old('nama')" required autofocus autocomplete="nama" />
                    <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                </section>
                <div class="grid grid-cols-2 gap-5">
                    @foreach ($dataKriteria as $kriteria)
                        <section>
                            <x-input-label for="{{ $kriteria->nama }}" value="{{ $kriteria->nama }}" />
                            <select class="w-full rounded-md border border-gray-300" name="{{ $kriteria->nama }}">
                                @foreach ($dataSubkriteria->where('id_kriteria', $kriteria->id) as $subkriteria)
                                    <option value="{{ $subkriteria->bobot }}">{{ $subkriteria->nama }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('{{ $kriteria->nama }}')" class="mt-2" />
                        </section>
                    @endforeach
                </div>
                <x-button type="submit" class="mt-5" x-on:click="show = false">
                    Simpan Data
                </x-button>
            </form>
        </div>
    </main>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Subkriteria') }}
        </h2>
    </x-slot>

    <main class="px-5 bg-white min-h-screen flex flex-col gap-5">
        @foreach ($dataKriteria as $kriteria)
            <section>
                <div class="flex justify-between mb-5">
                    <h1 class="font-semibold uppercase text-sm">{{ $kriteria->nama }}</h1>
                    <x-button type="primary" x-data="{ kriteria: {{ $kriteria }} }"
                        x-on:click.prevent="$dispatch('open-modal', { action: 'tambah-kriteria', kriteria})">
                        Tambah Data
                    </x-button>
                </div>
                <x-table :title="'Data Subkriteria'" :headers="['No', 'Nama Subkriteria', 'Bobot', 'Opsi']" :titleColspan="4">
                    @foreach ($dataSubkriteria->where('id_kriteria', $kriteria->id) as $subkriteria)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-center border">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center border">{{ $subkriteria->nama }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center border">{{ $subkriteria->bobot }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center border text-xl">
                                <i class="fa-solid fa-pen-to-square text-blue-500 cursor-pointer hover:brightness-90 duration-300"
                                    x-data="{ subkriteria: {{ $subkriteria }}, idKriteria: {{ $kriteria->id }} }"
                                    x-on:click="$dispatch('open-modal', {action: 'update-subkriteria', subkriteria: subkriteria, idKriteria: idKriteria})"></i>
                                <i class="fa-solid
                            fa-eraser text-red-500 cursor-pointer hover:brightness-90 duration-300"
                                    x-data="{ subkriteria: {{ $subkriteria }} }"
                                    x-on:click="window.location.href=`/data-subkriteria/delete/${subkriteria.id}`"></i>
                            </td>
                        </tr>
                    @endforeach
                </x-table>
            </section>
        @endforeach
    </main>
    <x-modal name="tambah-kriteria">
        <div class="p-5" x-data="{ kriteria: {} }" x-on:open-modal.window="kriteria = $event.detail.kriteria">
            <h1 class="font-semibold text-xl uppercase mb-5">Tambah Data Subkriteria</h1>
            <form method="POST" action="{{ route('subkriteria.add') }}" class="flex flex-col gap-y-3">
                @csrf
                <div class="grid grid-cols-2 gap-5">
                    <section>
                        <x-input-label for="nama" :value="__('Nama')" />
                        <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama"
                            placeholder="Masukan nama subkriteria..." :value="old('nama')" required autofocus
                            autocomplete="nama" />
                        <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                    </section>
                    <section>
                        <x-input-label for="bobot" :value="__('Bobot')" />
                        <x-text-input id="bobot" class="block mt-1 w-full" type="number" name="bobot"
                            placeholder="Masukan bobot subkriteria..." :value="old('bobot')" required autofocus
                            autocomplete="bobot" />
                        <x-input-error :messages="$errors->get('bobot')" class="mt-2" />
                    </section>
                    <x-text-input id="id_kriteria" class="block mt-1 w-full" type="hidden" name="id_kriteria"
                        x-model="kriteria.id" />
                </div>
                <x-button type="submit" class="mt-5" x-on:click="show = false">
                    Simpan Data
                </x-button>
            </form>
        </div>
    </x-modal>

    <x-modal name="update-subkriteria">
        <div class="p-5" x-data="{ subkriteria: {}, idKriteria: 0 }"
            x-on:open-modal.window="subkriteria = $event.detail.subkriteria; idKriteria = $event.detail.idKriteria">
            <h1 class="font-semibold text-xl uppercase mb-5">Update Data Subkriteria</h1>
            <form method="POST" :action="`/data-subkriteria/update/${subkriteria.id}`" class="flex flex-col gap-y-3">
                @csrf
                <div class="grid grid-cols-2 gap-5">
                    <section>
                        <x-input-label for="nama" :value="__('Nama')" />
                        <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama"
                            placeholder="Masukan nama kriteria..." :value="old('nama')" required autofocus
                            autocomplete="nama" x-model="subkriteria.nama" />
                        <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                    </section>
                    <section>
                        <x-input-label for="bobot" :value="__('Bobot')" />
                        <x-text-input id="bobot" class="block mt-1 w-full" type="number" name="bobot"
                            placeholder="Masukan bobot subkriteria..." :value="old('bobot')" required autofocus
                            autocomplete="bobot" x-model="subkriteria.bobot" />
                        <x-input-error :messages="$errors->get('bobot')" class="mt-2" />
                    </section>
                    <x-text-input id="id_kriteria" class="block mt-1 w-full" type="number" name="id_kriteria"
                        x-model="idKriteria" />
                </div>
                <x-button type="submit" class="mt-5" x-on:click="show = false">
                    Simpan Data
                </x-button>
            </form>
        </div>
    </x-modal>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Kriteria') }}
        </h2>
    </x-slot>

    <main class="px-5 bg-white min-h-screen">
        <div class="w-fit ml-auto mb-5">
            <x-button type="primary" x-data x-on:click.prevent="$dispatch('open-modal', { action: 'tambah-kriteria'})">
                Tambah Data
            </x-button>
        </div>
        <x-table :title="'Data Kriteria'" :headers="['No', 'Nama Kriteria', 'Opsi']" :titleColspan="3">
            @foreach ($dataKriteria as $kriteria)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-center border">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center border">{{ $kriteria->nama }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center border text-xl">
                        <i class="fa-solid fa-pen-to-square text-blue-500 cursor-pointer hover:brightness-90 duration-300"
                            x-data="{ kriteria: {{ $kriteria }} }"
                            x-on:click="$dispatch('open-modal', {action: 'update-kriteria', kriteria: kriteria})"></i>
                        <i class="fa-solid
                            fa-eraser text-red-500 cursor-pointer hover:brightness-90 duration-300"
                            x-data="{ kriteria: {{ $kriteria }} }"
                            x-on:click="window.location.href=`/data-kriteria/delete/${kriteria.id}`"></i>
                    </td>
                </tr>
            @endforeach
        </x-table>
    </main>
    <x-modal name="tambah-kriteria">
        <div class="p-5">
            <h1 class="font-semibold text-xl uppercase mb-5">Tambah Data Kriteria</h1>
            <form method="POST" action="{{ route('kriteria.add') }}" class="flex flex-col gap-y-3">
                @csrf
                <section>
                    <x-input-label for="nama" :value="__('Nama')" />
                    <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama"
                        placeholder="Masukan nama kriteria..." :value="old('nama')" required autofocus
                        autocomplete="nama" />
                    <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                </section>
                <x-button type="submit" class="mt-5" x-on:click="show = false">
                    Simpan Data
                </x-button>
            </form>
        </div>
    </x-modal>

    <x-modal name="update-kriteria">
        <div class="p-5" x-data="{ kriteria: {} }" x-on:open-modal.window="kriteria = $event.detail.kriteria">
            <h1 class="font-semibold text-xl uppercase mb-5">Update Data Kriteria</h1>
            <form method="POST" :action="`/data-kriteria/update/${kriteria.id}`" class="flex flex-col gap-y-3">
                @csrf
                <section>
                    <x-input-label for="nama" :value="__('Nama')" />
                    <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama"
                        placeholder="Masukan nama kriteria..." :value="old('nama')" required autofocus autocomplete="nama"
                        x-model="kriteria.nama" />
                    <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                </section>
                <x-button type="submit" class="mt-5" x-on:click="show = false">
                    Simpan Data
                </x-button>
            </form>
        </div>
    </x-modal>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Alternatif') }}
        </h2>
    </x-slot>

    <main class="px-5 bg-white min-h-screen">
        <div class="w-fit ml-auto mb-5">
            <x-button type="primary" x-data x-on:click.prevent="$dispatch('open-modal', { action: 'tambah-alternatif'})">
                Tambah Data
            </x-button>
        </div>
        <table class="min-w-full divide-y divide-gray-200 border">
            <thead>
                <tr>
                    <th colspan="7" scope="col"
                        class="px-6 py-3 border text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Data alternatif
                    </th>
                </tr>
                <tr>
                    <th scope="col"
                        class="px-6 py-3 border text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Nama
                    </th>
                    @foreach ($dataKriteria as $kriteria)
                        <th scope="col"
                            class="px-6 py-3 border text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ $kriteria->nama }}
                        </th>
                    @endforeach
                    <th scope="col"
                        class="px-6 py-3 border text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Opsi
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataAlternatif as $alternatif)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-center border">{{ $alternatif->nama }}</td>
                        @foreach ($alternatif->data as $value)
                            <td class="px-6 py-4 whitespace-nowrap text-center border">{{ $value }}</td>
                        @endforeach
                        <td class="px-6 py-4 whitespace-nowrap text-center border text-xl">
                            <i class="fa-solid fa-pen-to-square text-blue-500 cursor-pointer hover:brightness-90 duration-300"
                                x-data="{ alternatif: {{ $alternatif }} }"
                                x-on:click="$dispatch('open-modal', {action: 'update-alternatif', alternatif: alternatif})"></i>
                            <i class="fa-solid fa-eraser text-red-500 cursor-pointer hover:brightness-90 duration-300"
                                x-data="{ alternatif: {{ $alternatif }} }"
                                x-on:click="if (confirm('Apakah Anda yakin ingin menghapus data alternatif ini?')) { window.location.href='/data-alternatif/delete/' + alternatif.id }"></i>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
    <x-modal name="tambah-alternatif">
        <div class="p-5">
            <h1 class="font-semibold text-xl uppercase mb-5">Tambah Data alternatif</h1>
            <form method="POST" action="{{ route('alternatif.add') }}" class="flex flex-col gap-y-3">
                @csrf
                <section>
                    <x-input-label for="nama" :value="__('Nama')" />
                    <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama"
                        placeholder="Masukan nama alternatif..." :value="old('nama')" required autofocus
                        autocomplete="nama" />
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
                        {{-- <section>
                            <x-input-label for="{{ $kriteria->nama }}" value="{{ $kriteria->nama }}" />
                            <x-text-input id="{{ $kriteria->nama }}" class="block mt-1 w-full" type="number"
                                name="{{ $kriteria->nama }}"
                                placeholder="Masukan nilai {{ $kriteria->nama }} alternatif..." :value="old('{{ $kriteria->nama }}')" required
                                autofocus autocomplete="{{ $kriteria->nama }}" />
                            <x-input-error :messages="$errors->get('{{ $kriteria->nama }}')" class="mt-2" />
                        </section> --}}
                    @endforeach
                </div>
                <x-button type="submit" class="mt-5" x-on:click="show = false">
                    Simpan Data
                </x-button>
            </form>
        </div>
    </x-modal>

    <x-modal name="update-alternatif">
        <div class="p-5" x-data="{ alternatif: {} }" x-on:open-modal.window="alternatif = $event.detail.alternatif"
            x-init="$watch('alternatif', value => console.log(value.data['Fisik']))">
            <h1 class="font-semibold text-xl uppercase mb-5">Update Data Alternatif</h1>
            <form method="POST" :action="`/data-alternatif/update/${alternatif.id}`" class="flex flex-col gap-y-3">
                @csrf

                <section>
                    <x-input-label for="nama" :value="__('Nama')" />
                    <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama"
                        placeholder="Masukan nama alternatif..." :value="old('nama')" required autofocus
                        autocomplete="nama" x-model="alternatif.nama" />
                    <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                </section>
                <div class="grid grid-cols-2 gap-5">
                    @foreach ($dataKriteria as $kriteria)
                        <section>
                            <x-input-label for="{{ $kriteria->nama }}" value="{{ $kriteria->nama }}" />
                            <select class="w-full rounded-md border border-gray-300" name="{{ $kriteria->nama }}">
                                @foreach ($dataSubkriteria->where('id_kriteria', $kriteria->id) as $subkriteria)
                                    <option value="{{ $subkriteria->bobot }}"
                                        x-bind:selected="alternatif?.data?.['{{ $kriteria->nama }}'] == '{{ $subkriteria->bobot }}'">
                                        {{ $subkriteria->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('{{ $kriteria->nama }}')" class="mt-2" />
                        </section>
                        {{-- <section>
                                <x-input-label for="{{ $kriteria->nama }}" value="{{ $kriteria->nama }}" />
                                <x-text-input id="{{ $kriteria->nama }}" class="block mt-1 w-full" type="number"
                                    name="{{ $kriteria->nama }}"
                                    placeholder="Masukan nilai {{ $kriteria->nama }} alternatif..." :value="old('{{ $kriteria->nama }}')" required
                                    autofocus autocomplete="{{ $kriteria->nama }}" />
                                <x-input-error :messages="$errors->get('{{ $kriteria->nama }}')" class="mt-2" />
                            </section> --}}
                    @endforeach
                </div>

                <x-button type="submit" class="mt-5" x-on:click="show = false">
                    Simpan Data
                </x-button>
            </form>
        </div>
    </x-modal>
</x-app-layout>

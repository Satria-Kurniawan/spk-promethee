<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Atlet') }}
        </h2>
    </x-slot>

    <main class="px-5 bg-white min-h-screen">
        <div class="w-fit ml-auto mb-5">
            <x-button type="primary" x-data x-on:click.prevent="$dispatch('open-modal', { action: 'tambah-atlet'})">
                Tambah Data
            </x-button>
        </div>
        <x-table :title="'Data Atlet'" :headers="['Nama', 'Umur', 'Otot Kaki', 'Otot Lengan', 'Teknik', 'Prestasi', 'Opsi']" :titleColspan="7">
            @foreach ($dataAtlet as $atlet)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-center border">{{ $atlet->nama }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center border">{{ $atlet->umur }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center border">{{ $atlet->otot_kaki }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center border">{{ $atlet->otot_lengan }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center border">{{ $atlet->teknik }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center border">{{ $atlet->prestasi }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center border text-xl">
                        <i class="fa-solid fa-pen-to-square text-blue-500 cursor-pointer hover:brightness-90 duration-300"
                            x-data="{ atlet: {{ $atlet }} }"
                            x-on:click="$dispatch('open-modal', {action: 'update-atlet', atlet: atlet})"></i>
                        <i class="fa-solid
                            fa-eraser text-red-500 cursor-pointer hover:brightness-90 duration-300"
                            x-data="{ atlet: {{ $atlet }} }"
                            x-on:click="window.location.href=`/data-atlet/delete/${atlet.id}`"></i>

                    </td>
                </tr>
            @endforeach
        </x-table>
    </main>
    <x-modal name="tambah-atlet">
        <div class="p-5">
            <h1 class="font-semibold text-xl uppercase mb-5">Tambah Data Atlet</h1>
            <form method="POST" action="{{ route('atlet.add') }}" class="flex flex-col gap-y-3">
                @csrf
                <div class="grid grid-cols-2 gap-5">
                    <section>
                        <x-input-label for="nama" :value="__('Nama')" />
                        <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama"
                            placeholder="Masukan nama atlet..." :value="old('nama')" required autofocus
                            autocomplete="nama" />
                        <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                    </section>
                    <section>
                        <x-input-label for="umur" :value="__('Umur')" />
                        <x-text-input id="umur" class="block mt-1 w-full" type="number" name="umur"
                            placeholder="Masukan umur atlet..." :value="old('umur')" required autofocus
                            autocomplete="umur" />
                        <x-input-error :messages="$errors->get('umur')" class="mt-2" />
                    </section>
                    <section>
                        <x-input-label for="otot_kaki" :value="__('Nilai Otot Kaki')" />
                        <x-text-input id="otot_kaki" class="block mt-1 w-full" type="number" name="otot_kaki"
                            placeholder="Masukan nilai otot kaki..." :value="old('otot_kaki')" required autofocus
                            autocomplete="otot_kaki" />
                        <x-input-error :messages="$errors->get('otot_kaki')" class="mt-2" />
                    </section>
                    <section>
                        <x-input-label for="otot_lengan" :value="__('Nilai Otot Lengan')" />
                        <x-text-input id="otot_lengan" class="block mt-1 w-full" type="number" name="otot_lengan"
                            placeholder="Masukan nilai otot lengan..." :value="old('otot_lengan')" required autofocus
                            autocomplete="otot_lengan" />
                        <x-input-error :messages="$errors->get('otot_lengan')" class="mt-2" />
                    </section>
                    <section>
                        <x-input-label for="teknik" :value="__('Nilai Teknik')" />
                        <x-text-input id="teknik" class="block mt-1 w-full" type="number" name="teknik"
                            placeholder="Masukan nilai teknik..." :value="old('teknik')" required autofocus
                            autocomplete="teknik" />
                        <x-input-error :messages="$errors->get('teknik')" class="mt-2" />
                    </section>
                    <section>
                        <x-input-label for="prestasi" :value="__('Nilai Prestasi')" />
                        <x-text-input id="prestasi" class="block mt-1 w-full" type="number" name="prestasi"
                            placeholder="Masukan nilai prestasi..." :value="old('prestasi')" required autofocus
                            autocomplete="prestasi" />
                        <x-input-error :messages="$errors->get('prestasi')" class="mt-2" />
                    </section>
                </div>
                <x-button type="submit" class="mt-5" x-on:click="show = false">
                    Simpan Data
                </x-button>
            </form>
        </div>
    </x-modal>

    <x-modal name="update-atlet">
        <div class="p-5" x-data="{ atlet: {} }" x-on:open-modal.window="atlet = $event.detail.atlet">
            <h1 class="font-semibold text-xl uppercase mb-5">Update Data Atlet</h1>
            <form method="POST" :action="`/data-atlet/update/${atlet.id}`" class="flex flex-col gap-y-3">
                @csrf
                <div class="grid grid-cols-2 gap-5">
                    <section>
                        <x-input-label for="nama" :value="__('Nama')" />
                        <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama"
                            placeholder="Masukan nama atlet..." :value="old('nama')" required autofocus
                            autocomplete="nama" x-model="atlet.nama" />
                        <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                    </section>
                    <section>
                        <x-input-label for="umur" :value="__('Umur')" />
                        <x-text-input id="umur" class="block mt-1 w-full" type="number" name="umur"
                            placeholder="Masukan umur atlet..." :value="old('umur')" required autofocus
                            autocomplete="umur" x-model="atlet.umur" />
                        <x-input-error :messages="$errors->get('umur')" class="mt-2" />
                    </section>
                    <section>
                        <x-input-label for="otot_kaki" :value="__('Nilai Otot Kaki')" />
                        <x-text-input id="otot_kaki" class="block mt-1 w-full" type="number" name="otot_kaki"
                            placeholder="Masukan nilai otot kaki..." :value="old('otot_kaki')" required autofocus
                            autocomplete="otot_kaki" x-model="atlet.otot_kaki" />
                        <x-input-error :messages="$errors->get('otot_kaki')" class="mt-2" />
                    </section>
                    <section>
                        <x-input-label for="otot_lengan" :value="__('Nilai Otot Lengan')" />
                        <x-text-input id="otot_lengan" class="block mt-1 w-full" type="number" name="otot_lengan"
                            placeholder="Masukan nilai otot lengan..." :value="old('otot_lengan')" required autofocus
                            autocomplete="otot_lengan" x-model="atlet.otot_lengan" />
                        <x-input-error :messages="$errors->get('otot_lengan')" class="mt-2" />
                    </section>
                    <section>
                        <x-input-label for="teknik" :value="__('Nilai Teknik')" />
                        <x-text-input id="teknik" class="block mt-1 w-full" type="number" name="teknik"
                            placeholder="Masukan nilai teknik..." :value="old('teknik')" required autofocus
                            autocomplete="teknik" x-model="atlet.teknik" />
                        <x-input-error :messages="$errors->get('teknik')" class="mt-2" />
                    </section>
                    <section>
                        <x-input-label for="prestasi" :value="__('Nilai Prestasi')" />
                        <x-text-input id="prestasi" class="block mt-1 w-full" type="number" name="prestasi"
                            placeholder="Masukan nilai prestasi..." :value="old('prestasi')" required autofocus
                            autocomplete="prestasi" x-model="atlet.prestasi" />
                        <x-input-error :messages="$errors->get('prestasi')" class="mt-2" />
                    </section>
                </div>
                <x-button type="submit" class="mt-5" x-on:click="show = false">
                    Simpan Data
                </x-button>
            </form>
        </div>
    </x-modal>
</x-app-layout>

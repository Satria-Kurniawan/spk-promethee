<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Index Preferensi Multikriteria') }}
        </h2>
    </x-slot>

    <main class="px-5 bg-white min-h-screen flex 1 overflow-auto">
        <x-table :title="'Index Preferensi Multikriteria'" :titleColspan="4">
            <thead>
                <tr>
                    <th></th>
                    @foreach ($nilaiPreferensiMultikriteria as $row)
                        <th class="px-6 py-4 border">A{{ $loop->index + 1 }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($nilaiPreferensiMultikriteria as $row)
                    <tr>
                        <th class="px-6 py-4 border">A{{ $loop->index + 1 }}</th>
                        @foreach ($row as $value)
                            <td
                                class="px-6 py-4 whitespace-nowrap text-center border {{ is_null($value) ? 'bg-black/30' : 'bg-transparent' }}">
                                {{ $value }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </x-table>
    </main>
</x-app-layout>

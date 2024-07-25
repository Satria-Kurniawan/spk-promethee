<aside class="w-64 bg-black/80 h-screen sticky top-0 p-5 text-white">
    <a href="{{ url('/') }}" class="hover:text-green-500 duration-300">
        <h1 class="font-bold text-2xl">PROMETHEE</h1>
    </a>
    <ul class="flex flex-col gap-y-5 font-semibold text-lg mt-20">
        <li class="{{ Route::is('dashboard') ? 'text-green-500' : '' }} cursor-pointer">
            <a href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        <li class="{{ Route::is('data-kriteria') ? 'text-green-500' : '' }} cursor-pointer">
            <a href="{{ route('data-kriteria') }}">Data Kriteria</a>
        </li>
        <li class="{{ Route::is('data-subkriteria') ? 'text-green-500' : '' }} cursor-pointer">
            <a href="{{ route('data-subkriteria') }}">Data Subkriteria</a>
        </li>
        <li class="{{ Route::is('data-alternatif') ? 'text-green-500' : '' }} cursor-pointer">
            <a href="{{ route('data-alternatif') }}">Data Alternatif</a>
        </li>
        <li class="{{ Route::is('nilai-preferensi-kriteria') ? 'text-green-500' : '' }} cursor-pointer">
            <a href="{{ route('nilai-preferensi-kriteria') }}">Preferensi Kriteria</a>
        </li>
        <li class="{{ Route::is('nilai-preferensi-multikriteria') ? 'text-green-500' : '' }} cursor-pointer">
            <a href="{{ route('nilai-preferensi-multikriteria') }}">Preferensi Multikriteria</a>
        </li>
        <li class="{{ Route::is('nilai-flow') ? 'text-green-500' : '' }} cursor-pointer">
            <a href="{{ route('nilai-flow') }}">Nilai Flow</a>
        </li>
        <li class="{{ Route::is('perankingan') ? 'text-green-500' : '' }} cursor-pointer">
            <a href="{{ route('perankingan') }}">Perhitungan</a>
        </li>
        {{-- <li class="{{ Route::is('atlet.input') ? 'text-green-500' : '' }} cursor-pointer">
            <a href="{{ route('atlet.input') }}">Input Atlet</a>
        </li> --}}
    </ul>
</aside>

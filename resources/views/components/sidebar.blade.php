<aside class="w-80 bg-black/80 h-screen sticky top-0 p-5 text-white">
    <h1 class="font-bold text-2xl">PROMETHEE</h1>
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
        <li class="{{ Route::is('data-atlet') ? 'text-green-500' : '' }} cursor-pointer">
            <a href="{{ route('data-atlet') }}">Data Atlet</a>
        </li>
        <li class="{{ Route::is('nilai-preferensi-kriteria') ? 'text-green-500' : '' }} cursor-pointer">
            <a href="{{ route('nilai-preferensi-kriteria') }}">Nilai Preferensi Kriteria</a>
        </li>
        <li class="{{ Route::is('nilai-preferensi-multikriteria') ? 'text-green-500' : '' }} cursor-pointer">
            <a href="{{ route('nilai-preferensi-multikriteria') }}">Index Preferensi Multikriteria</a>
        </li>
        <li class="{{ Route::is('nilai-flow') ? 'text-green-500' : '' }} cursor-pointer">
            <a href="{{ route('nilai-flow') }}">Nilai Flow</a>
        </li>
        <li class="{{ Route::is('perankingan') ? 'text-green-500' : '' }} cursor-pointer">
            <a href="{{ route('perankingan') }}">Perankingan</a>
        </li>
    </ul>
</aside>

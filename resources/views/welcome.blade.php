<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased">
    <main class="container mx-auto px-20 pb-10">
        <nav class="py-4 flex justify-between">
            <div>
                <h1 class="font-bold tracking-wider">ADIWIRATAMA</h1>
            </div>
            <ul class="flex gap-x-5 items-center">

                @guest
                    <li>
                        <button class="hover:text-green-500">
                            <a href="{{ route('login') }}">
                                Login
                            </a>
                        </button>
                    </li>
                    <li>
                        <button
                            class="border border-black py-2 px-5 rounded-md flex gap-x-3 items-center hover:bg-black hover:text-white">
                            <a href="{{ route('login') }}">
                                Register
                            </a>
                            <span>&rarr;</span>
                        </button>
                    </li>
                @endguest
                @auth
                    <li>
                        <button
                            class="border border-black py-2 px-5 rounded-md flex gap-x-3 items-center hover:bg-black hover:text-white">
                            <a href="{{ route('dashboard') }}">
                                Dashboard
                            </a>
                            <span>&rarr;</span>
                        </button>
                    </li>
                @endauth
            </ul>
        </nav>
        <section class="flex gap-x-5 py-10 mt-5">
            <div class="max-w-xl">
                <h1 class="font-extrabold text-5xl trackin">Sistem Pendukung Keputusan Metode
                    <span class="text-transparent bg-gradient-to-r from-blue-500 to-green-500 bg-clip-text">
                        Promethee
                    </span>
                </h1>
                <p class="mt-3 max-w-lg tracking-wider font-light mb-5">
                    Mengoptimalkan Keputusan dengan Cerdas: Memahami Metode PROMETHEE dalam Sistem
                    Pendukung Keputusan.
                </p>
                <button class="bg-black text-white py-2 px-5 rounded-md flex gap-x-3 items-center hover:bg-green-700">
                    <a href="{{ route('login') }}">
                        Login
                    </a>
                    <span>&rarr;</span>
                </button>
            </div>
            <div>
                <img src="/hero.svg" alt="Hero">
            </div>
        </section>

        <x-table :title="'Hasil Perankingan'" :headers="['Nama', 'Leaving Flow', 'Entering Flow', 'Net Flow', 'Ranking']" :titleColspan="5">
            @foreach ($hasilPerankingan as $alternatif)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-center border">{{ $alternatif['nama'] }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center border">{{ $alternatif['leavingFlow'] }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center border">{{ $alternatif['enteringFlow'] }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center border">{{ $alternatif['netFlow'] }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center border">{{ $loop->index + 1 }}</td>
                </tr>
            @endforeach
        </x-table>
    </main>
</body>

</html>

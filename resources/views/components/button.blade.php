@props(['variant' => 'primary'])

<button
    {{ $attributes->merge(['class' => 'bg-green-500 py-1.5 px-3 text-white rounded-md hover:brightness-90 duration-300']) }}>
    {{ $slot }}
</button>

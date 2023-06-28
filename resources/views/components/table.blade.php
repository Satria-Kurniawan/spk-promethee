@props(['title', 'headers' => [], 'titleColspan' => 1])

<table {{ $attributes->merge(['class' => 'min-w-full divide-y divide-gray-200 border']) }}>
    <thead>
        <tr>
            <th colspan="{{ $titleColspan }}" scope="col"
                class="px-6 py-3 border text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                {{ $title }}
            </th>
        </tr>
        <tr>
            @foreach ($headers as $header)
                <th scope="col"
                    class="px-6 py-3 border text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                    {{ $header }}
                </th>
            @endforeach
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        {{ $slot }}
    </tbody>
</table>

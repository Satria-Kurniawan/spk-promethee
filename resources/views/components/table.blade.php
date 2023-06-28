@props(['headers', 'data'])

<table {{ $attributes->merge(['class' => 'min-w-full divide-y divide-gray-200 border border-black']) }}>
    <thead>
        <tr>
            @foreach ($headers as $header)
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    {{ $header }}
                </th>
            @endforeach
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        {{ $slot }}
    </tbody>
</table>

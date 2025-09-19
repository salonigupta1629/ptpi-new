@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'p-2 border-gray-300 bg-gray-200 border rounded-md shadow-sm']) }}>

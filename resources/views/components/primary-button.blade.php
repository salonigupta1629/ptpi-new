<button {{ $attributes->merge(['type' => 'submit', 'class' => 'w-full items-center px-4 py-3 bg-teal-600 hover:bg-teal-700  border border-transparent rounded-md text-center text-sm text-gray-200 font-semibold uppercase tracking-widest   transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>

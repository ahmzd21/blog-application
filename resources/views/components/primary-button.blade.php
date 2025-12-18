<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2.5 bg-gold border border-transparent rounded-xl font-semibold text-sm text-white tracking-wide hover:bg-yellow-600 focus:bg-yellow-700 active:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-gold focus:ring-offset-2 dark:focus:ring-offset-gray-900 transition ease-in-out duration-200']) }}>
    {{ $slot }}
</button>

@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-gold dark:focus:border-gold focus:ring-gold dark:focus:ring-gold rounded-xl shadow-sm transition-colors duration-200']) }}>

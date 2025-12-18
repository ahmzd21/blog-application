<div class="bg-white dark:bg-gray-900 my-4 overflow-hidden shadow-sm sm:rounded-xl border border-gray-200 dark:border-gray-800 transition-colors duration-300">
    <div class="p-3">
        <ul class="flex flex-wrap text-sm font-medium text-center justify-center gap-2">
            <li>
                <a href="{{ route('dashboard') }}" class="{{ Route::is('dashboard') ? 'bg-gold text-white' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white' }} inline-block px-4 py-2 rounded-lg transition-colors duration-200" aria-current="{{ Route::is('dashboard') ? 'page' : '' }}">All</a>
            </li>
            @foreach($categories as $category)
                <li>
                    <a href="{{ route('post.category', $category->slug) }}" class="{{ (Route::is('post.category') && request()->route('category')->slug == $category->slug) ? 'bg-gold text-white' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white' }} inline-block px-4 py-2 rounded-lg transition-colors duration-200" aria-current="{{ Route::is('post.category') && request()->route('category')->slug == $category->slug }}">{{ $category->name }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</div>

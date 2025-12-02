<div class="bg-white my-4 overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-2 text-gray-900">
        <ul class="flex flex-wrap text-sm font-medium text-center justify-center text-body">
            <li class="me-2">
                <a href="{{ route('dashboard') }}" class="{{ Route::is('dashboard') ? 'bg-blue-600 text-white' : 'hover:bg-gray-100 hover:text-gray-900' }} inline-block px-4 py-2 rounded-lg" aria-current="{{ Route::is('dashboard') ? 'page' : '' }}">All</a>
            </li>
            @foreach($categories as $category)
                <li class="me-2">
                    <a href="{{ route('post.category', $category->slug) }}"  class="{{ (Route::is('post.category') && request()->route('category')->slug == $category->slug) ? 'bg-blue-600 text-white' : 'hover:bg-gray-100 hover:text-gray-900' }} inline-block px-4 py-2 rounded-lg" aria-current="{{ Route::is('post.category') && request()->route('category')->slug == $category->slug }}">{{ $category->name }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</div>

<x-app-layout>
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <x-category-tab :categories="$categories"/>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="px-3 py-1 text-gray-900">
                @forelse($posts as $index => $post)
                    <x-post-item :post="$post" :index='$index' :count="$posts->count()"/>
                @empty
                    <p class="text-gray-300 text-xl text-center py-52">No Posts found</p>
                @endforelse
            </div>
        </div>
        <div class="py-4">
            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>

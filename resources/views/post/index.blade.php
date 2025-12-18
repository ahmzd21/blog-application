<x-app-layout>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <x-category-tab :categories="$categories"/>
        
        <div class="grid gap-6">
            @forelse($posts as $post)
                <x-post-item :post="$post" />
            @empty
                <div class="text-center py-24">
                    <svg class="mx-auto h-16 w-16 text-gray-400 dark:text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3 class="mt-4 text-xl font-semibold text-gray-900 dark:text-white">No posts yet</h3>
                    <p class="mt-2 text-gray-500 dark:text-gray-400">Be the first to share something!</p>
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>

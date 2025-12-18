<div class="group flex flex-col md:flex-row bg-white dark:bg-gray-900 rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-800 hover:border-gold/50 dark:hover:border-gold/50 transition-all duration-300 hover:shadow-lg">
    <!-- Content -->
    <div class="flex flex-col flex-1 p-6">
        <a href="{{ route('post.show', [$post->user->username, $post->slug]) }}" class="block mb-3">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white group-hover:text-gold transition-colors duration-200 line-clamp-2">
                {{ $post->title }}
            </h2>
        </a>
        
        <p class="text-gray-600 dark:text-gray-400 mb-4 line-clamp-2 flex-grow">
            {{ Str::words(strip_tags($post->content), 24, '...') }}
        </p>

        <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-100 dark:border-gray-800">
            <div class="flex items-center gap-3">
                <x-user-avatar :user="$post->user" size="h-8 w-8" />
                <div class="text-sm">
                    <span class="text-gray-900 dark:text-white font-medium">{{ $post->user->name }}</span>
                    <div class="text-gray-500 dark:text-gray-500">
                        {{ $post->created_at->format('M d') }} · {{ $post->readTime() }} min
                    </div>
                </div>
            </div>
            
            @auth
                <x-like-button :post="$post" />
            @endauth
        </div>
    </div>

    <!-- Image -->
    @if($post->getFirstMedia())
        <div class="w-full md:w-48 h-48 md:h-auto flex-shrink-0">
            <img src="{{ $post->getFirstMedia()->getUrl('preview') }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
        </div>
    @endif
</div>

<x-app-layout>
    <article class="min-h-screen">
        <!-- Hero Section -->
        <header class="relative bg-gradient-to-b from-gray-100 to-cream dark:from-gray-800 dark:to-obsidian transition-colors duration-300">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center">
                <!-- Category Badge -->
                <a href="{{ route('post.category', $category) }}" class="inline-flex items-center px-4 py-1.5 text-xs font-bold tracking-wider text-gold uppercase border-2 border-gold rounded-full hover:bg-gold hover:text-white transition-all duration-300 mb-6">
                    {{ $category->name }}
                </a>

                <!-- Title -->
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-gray-900 dark:text-white tracking-tight leading-tight mb-8">
                    {{ $post->title }}
                </h1>

                <!-- Meta Info -->
                <div class="flex flex-wrap items-center justify-center gap-4 text-sm text-gray-600 dark:text-gray-400">
                    <div class="flex items-center gap-3">
                        <x-user-avatar :user="$user" size="h-10 w-10" />
                        <div class="text-left">
                            <a href="{{ route('profile.show', $user) }}" class="font-semibold text-gray-900 dark:text-white hover:text-gold transition-colors">{{ $user->name }}</a>
                        </div>
                    </div>
                    <span class="hidden sm:inline text-gray-400">•</span>
                    <span>{{ $post->created_at->format('M d, Y') }}</span>
                    <span class="hidden sm:inline text-gray-400">•</span>
                    <span>{{ $post->readTime() }} min read</span>
                </div>

                <!-- Action Buttons -->
                @if(auth()->id() === $post->user_id || (auth()->user() && auth()->user()->hasRole('admin')))
                    <div class="flex items-center justify-center gap-3 mt-8">
                        <a href="{{ route('post.edit', $post) }}" class="inline-flex items-center px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            Edit Post
                        </a>
                        <form action="{{ route('post.destroy', $post) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-xl transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                Delete
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </header>

        <!-- Featured Image -->
        @if($post->getFirstMedia())
            <div class="relative -mt-8 mx-4 sm:mx-auto max-w-5xl">
                <div class="aspect-video rounded-2xl overflow-hidden shadow-2xl ring-1 ring-black/5 dark:ring-white/10">
                    <img src="{{ $post->getFirstMedia()->getUrl('') }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                </div>
            </div>
        @endif

        <!-- Content -->
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="prose prose-lg dark:prose-invert max-w-none
                        prose-headings:font-bold prose-headings:tracking-tight prose-headings:text-gray-900 dark:prose-headings:text-white
                        prose-p:text-gray-700 dark:prose-p:text-gray-300 prose-p:leading-relaxed
                        prose-a:text-gold prose-a:font-semibold prose-a:no-underline hover:prose-a:underline
                        prose-strong:text-gray-900 dark:prose-strong:text-white
                        prose-blockquote:border-l-gold prose-blockquote:bg-gray-50 dark:prose-blockquote:bg-gray-800/50 prose-blockquote:py-1 prose-blockquote:px-4 prose-blockquote:rounded-r-lg
                        prose-code:text-gold prose-code:bg-gray-100 dark:prose-code:bg-gray-800 prose-code:px-1.5 prose-code:py-0.5 prose-code:rounded
                        prose-img:rounded-xl prose-img:shadow-lg">
                {!! $post->content !!}
            </div>

            <!-- Like Section -->
            <div class="flex items-center justify-between py-8 mt-8 border-t border-b border-gray-200 dark:border-gray-800">
                <div class="flex items-center gap-4">
                    <x-like-button :post="$post" />
                    <span class="text-sm text-gray-500 dark:text-gray-400">{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</span>
                </div>
                <a href="{{ route('post.category', $category) }}" class="text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-gold transition-colors">
                    More in {{ $category->name }} →
                </a>
            </div>

            <!-- Comments -->
            <x-comments :post="$post" />
        </div>
    </article>
</x-app-layout>

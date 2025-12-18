@props(['post'])

<div class="mt-12 bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 overflow-hidden transition-colors duration-300">
    <div class="p-6 border-b border-gray-200 dark:border-gray-800">
        <h3 class="text-xl font-bold text-gray-900 dark:text-white">
            Comments <span class="text-gray-500 dark:text-gray-400 font-normal">({{ $post->comments->count() }})</span>
        </h3>
    </div>

    <div class="divide-y divide-gray-100 dark:divide-gray-800">
        @forelse($post->comments as $comment)
            <div class="p-6">
                <div class="flex items-start gap-4">
                    <x-user-avatar :user="$comment->user" size="h-10 w-10" />
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between mb-1">
                            <span class="font-semibold text-gray-900 dark:text-white">{{ $comment->user->name }}</span>
                            <span class="text-sm text-gray-500 dark:text-gray-400">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-gray-700 dark:text-gray-300">{{ $comment->content }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="p-12 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                <p class="mt-4 text-gray-500 dark:text-gray-400">No comments yet. Be the first to share your thoughts!</p>
            </div>
        @endforelse
    </div>

    @auth
        <div class="p-6 bg-gray-50 dark:bg-gray-800/50 border-t border-gray-200 dark:border-gray-800">
            <form action="{{ route('comments.store', $post) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Add a comment</label>
                    <textarea 
                        name="content" 
                        id="content" 
                        rows="3" 
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-gold focus:border-transparent transition-colors duration-200"
                        placeholder="Write your comment here..."
                        required
                    ></textarea>
                    <x-input-error :messages="$errors->get('content')" class="mt-2" />
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-gold text-white font-semibold rounded-xl hover:bg-yellow-600 transition-colors duration-200">
                        Post Comment
                    </button>
                </div>
            </form>
        </div>
    @else
        <div class="p-6 bg-gray-50 dark:bg-gray-800/50 border-t border-gray-200 dark:border-gray-800 text-center">
            <p class="text-gray-600 dark:text-gray-400">
                <a href="{{ route('login') }}" class="font-semibold text-gold hover:underline">Log in</a> to leave a comment.
            </p>
        </div>
    @endauth
</div>

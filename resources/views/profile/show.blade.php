<x-app-layout>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 overflow-hidden transition-colors duration-300">
            <div class="md:flex">
                <!-- Sidebar -->
                <aside class="md:w-80 p-6 md:p-8 border-b md:border-b-0 md:border-r border-gray-200 dark:border-gray-800">
                    <div class="text-center md:text-left">
                        <x-user-avatar :user="$user" size="h-24 w-24 mx-auto md:mx-0" />
                        
                        <h1 class="mt-4 text-2xl font-bold text-gray-900 dark:text-white">{{ $user->name }}</h1>
                        
                        @if($user->username)
                            <p class="text-gray-500 dark:text-gray-400">@{{ $user->username }}</p>
                        @endif
                        
                        @if($user->bio)
                            <p class="mt-4 text-gray-700 dark:text-gray-300">{{ $user->bio }}</p>
                        @endif
                        
                        <x-follower-ctr :user="$user" class="mt-6">
                            <div class="flex items-center justify-center md:justify-start gap-4 text-sm">
                                <div class="text-center">
                                    <span class="block text-xl font-bold text-gray-900 dark:text-white" x-text="count">{{ $user->followers()->count() }}</span>
                                    <span class="text-gray-500 dark:text-gray-400">Followers</span>
                                </div>
                                <div class="text-center">
                                    <span class="block text-xl font-bold text-gray-900 dark:text-white">{{ $user->following()->count() }}</span>
                                    <span class="text-gray-500 dark:text-gray-400">Following</span>
                                </div>
                                <div class="text-center">
                                    <span class="block text-xl font-bold text-gray-900 dark:text-white">{{ $posts->count() }}</span>
                                    <span class="text-gray-500 dark:text-gray-400">Posts</span>
                                </div>
                            </div>
                            
                            {{-- Only show follow button for non-admin authenticated users --}}
                            @if(auth()->user() && auth()->user()->id !== $user->id && !auth()->user()->hasRole('admin'))
                                <button 
                                    @click="follow()" 
                                    class="mt-6 w-full py-2.5 rounded-xl font-semibold transition-all duration-200"
                                    :class="following ? 'bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-white hover:bg-gray-300 dark:hover:bg-gray-600' : 'bg-gold text-white hover:bg-yellow-600'"
                                    x-text="following ? 'Following' : 'Follow'"
                                ></button>
                            @elseif(!auth()->user())
                                <a href="{{ route('register') }}" class="mt-6 block w-full py-2.5 rounded-xl font-semibold text-center bg-gold text-white hover:bg-yellow-600 transition-colors duration-200">
                                    Follow
                                </a>
                            @endif
                        </x-follower-ctr>
                    </div>
                </aside>
                
                <!-- Posts -->
                <main class="flex-1 p-6 md:p-8">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Posts</h2>
                    
                    <div class="space-y-4">
                        @forelse($posts as $post)
                            <x-post-item :post="$post" />
                        @empty
                            <div class="text-center py-12">
                                <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <p class="mt-4 text-gray-500 dark:text-gray-400">No posts yet</p>
                            </div>
                        @endforelse
                    </div>
                </main>
            </div>
        </div>
    </div>
</x-app-layout>

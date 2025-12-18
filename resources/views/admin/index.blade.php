<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Stats -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold mb-2">Total Users</h3>
                    <p class="text-3xl">{{ $usersCount }}</p>
                    <a href="{{ route('admin.users.index') }}" class="text-blue-500 hover:underline mt-2 block">Manage Users</a>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold mb-2">Total Posts</h3>
                    <p class="text-3xl">{{ $postsCount }}</p>
                    <a href="{{ route('admin.posts.index') }}" class="text-blue-500 hover:underline mt-2 block">Manage Posts</a>
                </div>
            </div>

            <!-- Recent Posts -->
            <div class="mt-8 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Recent Posts</h3>
                <ul>
                    @foreach($recentPosts as $post)
                        <li class="border-b last:border-0 py-2 flex justify-between items-center">
                            <span>{{ $post->title }} (by {{ $post->user->name }})</span>
                            <a href="{{ route('post.show', [$post->user->username, $post->slug]) }}" class="text-sm text-gray-600 hover:text-black">View</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>

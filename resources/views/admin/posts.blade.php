<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="border-b">
                                <th class="pb-2">Title</th>
                                <th class="pb-2">Author</th>
                                <th class="pb-2">Date</th>
                                <th class="pb-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                                <tr class="border-b last:border-0">
                                    <td class="py-3">
                                        <a href="{{ route('post.show', [$post->user->username, $post->slug]) }}" class="hover:underline font-bold">{{ $post->title }}</a>
                                    </td>
                                    <td class="py-3">{{ $post->user->name }}</td>
                                    <td class="py-3">{{ $post->created_at->format('M d, Y') }}</td>
                                    <td class="py-3">
                                        <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

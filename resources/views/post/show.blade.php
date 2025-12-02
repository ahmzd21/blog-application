<x-app-layout>
    <div class="bg-white max-w-6xl my-4 mx-auto py-8 rounded-md sm:px-6 lg:px-12 space-y-8">
        <h1 class="text-5xl font-black">{{ $post->title }}</h1>
{{--        Post Header Section--}}
        <div class="flex items-center gap-4 justify-between">
            <div class="flex items-center gap-4">
                <x-user-avatar :user="$user" size="h-14 w-14" />
                <div>
                    <div class="flex gap-2 text-[15px]">
                        <a href="{{ route('profile.show', $user) }}" class="hover:underline">{{ $user->name }}</a>
                        <x-follower-ctr :user="$user">
                            @if(auth()->user() && auth()->user()->id!==$user->id)
                                &middot;
                            <span @click="follow()" x-text="following ? 'Unfollow' : 'Follow'" :class="following ? 'text-black font-[400] hover:underline hover:cursor-pointer' : 'text-green-600 hover:underline hover:cursor-pointer'"></span>
                            @elseif(!auth()->user())
                                <a href="{{ route('register') }}" class="text-green-600 hover:underline">Follow</a>
                            @endif
                        </x-follower-ctr>
                    </div>
                    <div class="flex gap-2 text-gray-500 text-sm">
                        <p>{{ $post->readTime() }} min read</p>
                        &middot;
                        <p>{{ $post->created_at->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>
            @if(auth()->id() === $post->user_id)
                <div class="flex gap-2">
                    <a href="{{ route('post.edit', $post) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Edit
                    </a>
                    <form action="{{ route('post.destroy', $post) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <x-danger-button type="submit">Delete</x-danger-button>
                    </form>
                </div>
            @endif
        </div>
{{--        Post Like Section--}}
        @auth
            <div class="flex items-center border-t border-b p-2">
                <x-like-button :post="$post" />
            </div>
        @endauth
{{--        Post Content Section--}}
        <div class="">
            <img src="{{ $post->getFirstMedia()?->getUrl('') }}" class="block mx-auto h-auto w-9/12 px-10 object-cover mb-4">
            <div class="px-8 prose max-w-none">{!! Str::markdown($post->content) !!}</div>
        </div>
{{--        Post Footer Section--}}
        <div class="flex items-center gap-4 p-2">
            <a href="{{ route('post.category', $category) }}" class="bg-gray-200 text-gray-600 rounded-3xl py-2 px-4">
                {{ $category->name }}
            </a>
        </div>
    </div>
</x-app-layout>

<div class="flex flex-row my-3 p-2">
    <div class="flex flex-col w-full h-36 p-2 justify-evenly">
        <a href="#">
            <h5 class="text-2xl font-semibold tracking-tight text-heading px-1">{{ $post->title }}</h5>
        </a>
        <p class="mb-2 text-body px-1">{{ Str::words(strip_tags(Str::markdown($post->content)), 24, '...') }}</p>
        <div class="flex items-center gap-3">
            <x-primary-button class="w-32">
                <a href="{{ route('post.show', [$post->user->username, $post->slug]) }}" class="relative flex items-center justify-evenly">
                    Read more
                    <svg class="w-4 h-4 ms-1.5 rtl:rotate-180 -me-0.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4"/></svg>
                </a>
            </x-primary-button>
            <div class="flex gap-2 text-gray-500 text-sm">
                <p>{{ $post->created_at->format('M d, Y') }}</p>
                &bullet;
                @auth
                    <x-like-button :post="$post" />
                @endauth
            </div>
        </div>
    </div>
    <img class="rounded-lg h-36 w-36 object-cover mr-2" src="{{ $post->getFirstMedia()?->getUrl('preview') }}" alt="" />
</div>
@if($index != $count - 1)
    <div class="border-b border-gray-200 w-4/5 mx-auto"></div>
@endif


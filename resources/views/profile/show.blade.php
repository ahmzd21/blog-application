<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-sm">
                <div class="flex">
                    <div class="flex-1 pr-6 border-r">
                        <h1 class="font-semibold text-3xl pl-5 pb-5 border-b">{{ $user-> name }}</h1>
                        <div>
                            @foreach($posts as $index => $post)
                                <x-post-item :post="$post" :index="$index" :count="$posts->count()"/>
                            @endforeach
                        </div>
                    </div>
                     <x-follower-ctr :user="$user" class="w-[320px] px-8 space-y-2 text-[15px]">
                        <x-user-avatar :user="$user" size="h-12 w-12" />
                        <h3 class="font-semibold">{{ $user-> name }}</h3>
                        <p class="text-gray-600"><span x-text="count"></span> Followers</p>
                        <p class="text-gray-600">{{ $user->bio }}</p>
                        @if(auth()->user() && auth()->user()->id!==$user->id)
                            <div>
                                <span class="font-[450] inline-block mt-4 px-4 py-2 rounded-full" @click="follow()" x-text="following ? 'Unfollow' : 'Follow'" :class="following ? 'bg-green-600 text-white' : 'bg-white font-thin text-gray-900 border border-black'"></span>
                            </div>
                        @elseif(!auth()->user())
                            <div>
                                <a href="{{ route('register') }}" class="bg-green-600 text-white font-[450] inline-block mt-4 px-4 py-2 rounded-full">Follow</a>
                            </div>
                        @endif
                     </x-follower-ctr>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

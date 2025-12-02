@props(['user', 'size' => 'w-10 h-10'])
<div>
    @if($user->hasMedia('avatar'))
        <img src="{{ $user->getFirstMediaUrl('avatar', 'avatar') }}" class="rounded-full {{ $size }} object-cover">
    @else
        <img src="/avatar.png" class="{{ $size }}" alt="profile picture">
    @endif
</div>

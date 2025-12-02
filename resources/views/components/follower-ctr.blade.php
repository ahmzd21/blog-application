@props(['user', 'class' => ''])
<div class="{{ $class }}" x-data="{
                    following: {{ $user->isFollowedBy(auth()->user()) ? 'true' : 'false' }},
                    count: {{ $user->followers()->count() }},
                    follow() {
                        this.following = !this.following
                        axios.post('/follow/{{ $user->id }}')
                            .then(res => {
                                console.log(res.data)
                                this.count = res.data.count
                            })
                            .catch(err => {
                                console.log(err)
                            })
                    }
                    }"
>
    {{ $slot }}
</div>

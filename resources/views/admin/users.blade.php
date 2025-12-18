<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="border-b">
                                <th class="pb-2">ID</th>
                                <th class="pb-2">Name</th>
                                <th class="pb-2">Email</th>
                                <th class="pb-2">Joined</th>
                                <th class="pb-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr class="border-b last:border-0">
                                    <td class="py-3">{{ $user->id }}</td>
                                    <td class="py-3">{{ $user->name }}</td>
                                    <td class="py-3">{{ $user->email }}</td>
                                    <td class="py-3">{{ $user->created_at->format('M d, Y') }}</td>
                                    <td class="py-3">
                                        @if($user->id !== auth()->id())
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <div class=" bg-white max-w-6xl my-4 mx-auto py-6 rounded-md sm:px-6 lg:px-8">
        <div>
            <form action="{{ route('post.update', $post) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- Title -->
                <div>
                    <x-input-label for="title" :value="__('Title')" />
                    <x-text-input id="title" class="block mt-1 w-full"
                                  type="text"
                                  name="title"
                                  :value="old('title', $post->title)"
                                  required autofocus />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <!-- Content (Markdown Editor) -->
                <div class="mt-4">
                    <x-input-label for="content" :value="__('Content')" />
                    <x-textarea-input id="content" class="block mt-1 w-full" rows="20" type="text" name="content">{{ old('content', $post->content) }}</x-textarea-input>
                    <x-input-error :messages="$errors->get('content')" class="mt-2" />
                </div>

                <!-- Image -->
                <div class="mt-4">
                    <x-input-label class="block text-sm font-medium text-heading" for="image">Upload file</x-input-label>
                    <div class="mb-2">
                        <img src="{{ $post->getFirstMediaUrl('default', 'preview') }}" class="w-32 h-32 object-cover rounded-md">
                    </div>
                    <x-text-input id="image" class="w-full mt-1 block border" type="file" name="image" :value="old('image')" />
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG or GIF (MAX. 800x400px).</p>
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                </div>

                <!-- Category -->
                <div class="mt-4">
                    <x-input-label for="category_id" :value="__('Category')" />
                    <select id="category_id" name="category_id" class="w-full rounded-md mt-1 border-gray-300" required>
                        <option value="">Select a Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id', $post->category_id) == $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                </div>

                <div class="mt-6">
                    <x-primary-button type="submit">Update</x-primary-button>
                </div>
            </form>
        </div>
    </div>

    <!-- Initialize EasyMDE -->
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const easyMDE = new EasyMDE({
                    element: document.getElementById('content'),
                    spellChecker: false,
                    autosave: {
                        enabled: true,
                        uniqueId: "post_edit_content_{{ $post->id }}",
                        delay: 1000,
                    },
                });
            });
        </script>
    @endpush
</x-app-layout>

<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 overflow-hidden transition-colors duration-300">
            <div class="p-6 border-b border-gray-200 dark:border-gray-800">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Edit Post</h1>
            </div>
            
            <form action="{{ route('post.update', $post) }}" method="post" enctype="multipart/form-data" class="p-6 space-y-6">
                @csrf
                @method('PUT')
                
                <!-- Title -->
                <div>
                    <x-input-label for="title" :value="__('Title')" />
                    <x-text-input id="title" class="block mt-2 w-full"
                                  type="text"
                                  name="title"
                                  :value="old('title', $post->title)"
                                  placeholder="Enter a compelling title..."
                                  required autofocus />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <!-- Content -->
                <div>
                    <x-input-label for="content" :value="__('Content')" />
                    <x-textarea-input id="content" class="block mt-2 w-full" rows="20" type="text" name="content">{{ old('content', $post->content) }}</x-textarea-input>
                    <x-input-error :messages="$errors->get('content')" class="mt-2" />
                </div>

                <!-- Current Image -->
                <div>
                    <x-input-label :value="__('Current Image')" />
                    @if($post->getFirstMedia())
                        <div class="mt-2 relative w-48 h-32 rounded-xl overflow-hidden">
                            <img src="{{ $post->getFirstMediaUrl('default', 'preview') }}" class="w-full h-full object-cover">
                        </div>
                    @else
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">No image uploaded</p>
                    @endif
                </div>

                <!-- New Image -->
                <div>
                    <x-input-label for="image" :value="__('Replace Image (optional)')" />
                    <div class="mt-2 flex items-center justify-center w-full">
                        <label for="image" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 dark:border-gray-700 border-dashed rounded-xl cursor-pointer bg-gray-50 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                <p class="text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> a new image</p>
                            </div>
                            <input id="image" name="image" type="file" class="hidden" />
                        </label>
                    </div>
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                </div>

                <!-- Category -->
                <div>
                    <x-input-label for="category_id" :value="__('Category')" />
                    <select id="category_id" name="category_id" class="mt-2 w-full rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-gold focus:ring-gold transition-colors duration-200" required>
                        <option value="">Select a Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id', $post->category_id) == $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                </div>

                <div class="flex justify-end pt-4 border-t border-gray-200 dark:border-gray-800">
                    <x-primary-button type="submit">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Update Post
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
            tinymce.init({
                selector: 'textarea#content',
                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                skin: document.documentElement.classList.contains('dark') ? 'oxide-dark' : 'oxide',
                content_css: document.documentElement.classList.contains('dark') ? 'dark' : 'default',
            });
        </script>
    @endpush
</x-app-layout>

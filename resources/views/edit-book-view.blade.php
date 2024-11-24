<x-librarian-layout>
    <section class="bg-white">
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
            <h2 class="mb-6 text-2xl font-semibold text-gray-900">Add a New Book</h2>
            <form action="{{ route('books-update', $book->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Hidden Input untuk ID -->


                <input type="hidden" name="id" value="{{ $book->id }}">
                <!-- Pastikan id book benar-benar ada -->
                {{-- <p>Book ID: {{ $book->id }}</p> --}}
                <!-- Form Fields -->
                <div class="grid gap-6 sm:grid-cols-2 sm:gap-8">

                    <!-- Title Field -->
                    <div class="sm:col-span-2">
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Book's Title</label>
                        <input type="text" name="title" id="title"
                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3"  value="{{ old('title', $book->title) }}"
                            required>
                        @error('title')
                            <div class="mt-2 text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Author Field -->
                    <div>
                        <label for="author" class="block mb-2 text-sm font-medium text-gray-900">Author's Name</label>
                        <input type="text" name="author" id="author"
                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-3"  value="{{ old('author', $book->author) }}"
                            required>
                        @error('author')
                            <div class="mt-2 text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Categories Section with Checkboxes -->
                    <div class="sm:col-span-2">
                        <label for="categories" class="block mb-2 text-sm font-medium text-gray-900">Select
                            Categories</label>
                        <div class="grid grid-cols-2 gap-4">
                            @foreach ($categories as $category)
                                <div class="flex items-center">
                                    <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                        id="category_{{ $category->id }}"
                                        class="w-4 h-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    <label for="category_{{ $category->id }}"
                                        class="ml-2 text-sm text-gray-900">{{ $category->name }}</label>
                                </div>
                            @endforeach
                        </div>
                        @error('categories[]')
                            <div class="mt-2 text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- File Upload Section -->
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900" for="file_input">Upload Book
                            Image</label>
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                            aria-describedby="file_input_help" name="image" id="file_input" type="file">
                        <p class="mt-1 text-sm text-gray-500" id="file_input_help"> PNG, JPG (MAX. 800x400px).</p>
                        @error('image')
                            <div class="mt-2 text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description Field -->
                    <div class="sm:col-span-2">
                        <label for="description"
                            class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                        <textarea id="description" name="description" rows="6"
                            class="block w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 p-3"
                            placeholder="Provide a brief description of the book"></textarea>
                        @error('description')
                            <div class="mt-2 text-red-500 text-sm">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
                <button type="submit"
                    class="inline-flex items-center px-6 py-3 mt-6 text-sm font-medium text-center text-white bg-blue-600 rounded-lg focus:ring-4 focus:ring-blue-200 hover:bg-blue-700 transition-all duration-150">
                    Edit Book
                </button>
            </form>
        </div>
    </section>
</x-librarian-layout>

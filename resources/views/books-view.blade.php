<x-librarian-layout>
    <div class="flex flex-col gap-8 p-6">
        <!-- Books Section -->
        <div class="relative overflow-x-auto shadow-lg rounded-lg bg-white p-6">
            <h2 class="text-2xl font-semibold text-gray-900 mb-6 text-center">Books List</h2>

            <!-- Filter Form -->
            <form method="GET" action="{{ route('books-index') }}" class="flex flex-wrap gap-6 mb-6">
                <!-- Filter by Category -->
                <div class="flex-1 min-w-[200px]">
                    <label for="category_filter" class="block text-sm font-medium text-gray-700">Filter by
                        Category</label>
                    <select id="category_filter" name="category"
                        class="mt-1 block w-full bg-white border border-gray-300 text-sm text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter by User -->
                <div class="flex-1 min-w-[200px]">
                    <label for="user_filter" class="block text-sm font-medium text-gray-700">Filter by User</label>
                    <select id="user_filter" name="user"
                        class="mt-1 block w-full bg-white border border-gray-300 text-sm text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
                        <option value="">All Users</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ request('user') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>


                <!-- Apply Filters Button -->
                <div class="flex items-end min-w-[150px]">
                    <button type="submit"
                        class="w-full py-2 px-4 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-200">
                        Apply Filters
                    </button>
                </div>
            </form>

            <!-- Books Table -->
            <table class="min-w-full border border-gray-200 text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                    <tr>
                        <th scope="col" class="px-6 py-3 border-b">Image</th>
                        <th scope="col" class="px-6 py-3 border-b">Book's Title</th>
                        <th scope="col" class="px-6 py-3 border-b">Author</th>
                        <th scope="col" class="px-6 py-3 border-b">Description</th>
                        <th scope="col" class="px-6 py-3 border-b">Category</th>
                        <th scope="col" class="px-6 py-3 border-b">Borrowed by</th>
                        <th scope="col" class="px-6 py-3 border-b text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($books as $book)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <img src="{{ asset('storage/' . $book->image) }}" alt="Book Image"
                                    class="w-16 h-16 object-cover rounded-md shadow-md border border-gray-300">
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $book->title }}</td>
                            <td class="px-6 py-4">{{ $book->author }}</td>
                            <td class="px-6 py-4">
                                <p class="truncate w-56 text-gray-600" title="{{ $book->description }}">
                                    {{ Str::limit($book->description, 100) }}
                                </p>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($book->categories as $category)
                                        <span
                                            class="bg-gray-200 text-gray-800 text-xs font-semibold px-3 py-1 rounded-lg">
                                            {{ $category->name }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <form method="POST" action="{{ route('books-loan', $book->id) }}"
                                    id="loanForm_{{ $book->id }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="user_id_{{ $book->id }}"
                                            class="block text-sm text-gray-700">Select User to Loan</label>
                                        <select name="user_id" id="user_id_{{ $book->id }}"
                                            class="form-control w-full p-2.5 text-sm border rounded-md focus:ring-blue-500"
                                            onchange="document.getElementById('loanForm_{{ $book->id }}').submit()"
                                            required>
                                            <option value="" {{ is_null($book->user_id) ? 'selected' : '' }}>
                                                Choose a user</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}"
                                                    {{ $book->user_id == $user->id ? 'selected' : '' }}>
                                                    {{ $user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </form>

                                <!-- Reset Button -->
                                <form method="POST" action="{{ route('books-reset', $book->id) }}" class="mt-3">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="w-full py-2 px-4 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:ring-red-200">
                                        Reset
                                    </button>
                                </form>
                            </td>

                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('books-edit', $book->id) }}"
                                    class="text-blue-600 hover:text-blue-800 font-medium transition-all duration-150">
                                    Edit
                                </a>
                                <form action="{{ route('books-delete', $book->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-600 hover:text-red-800 font-medium transition-all duration-150 ml-4">
                                        Remove
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-librarian-layout>

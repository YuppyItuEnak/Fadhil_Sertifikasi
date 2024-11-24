<x-librarian-layout>


    <div class="container mx-auto my-8">
        <!-- Section for Users -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-8">
            <h2 class="text-2xl font-bold mb-4 text-gray-800">User Data</h2>
            <table class="table-auto w-full text-left border-collapse border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border border-gray-200">#</th>
                        <th class="px-4 py-2 border border-gray-200">Name</th>
                        <th class="px-4 py-2 border border-gray-200">Email</th>
                        <th class="px-4 py-2 border border-gray-200">Role</th>
                        <th class="px-4 py-2 border border-gray-200">Phone</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                {{ $user->id }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $user->name }}
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $user->email }}</td>
                            <td class="px-6 py-4">{{ $user->phone }}</td>
                            <td class="px-6 py-4">
                                {{ ucfirst($user->role) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Section for Books -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-4 text-gray-800">Books Data</h2>
            <table class="table-auto w-full text-left border-collapse border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border border-gray-200">Image</th>
                        <th class="px-4 py-2 border border-gray-200">Title</th>
                        <th class="px-4 py-2 border border-gray-200">Author</th>
                        <th class="px-4 py-2 border border-gray-200">Description</th>
                        <th class="px-4 py-2 border border-gray-200">Categories</th>
                    </tr>
                </thead>
                <tbody>
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
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>




</x-librarian-layout>

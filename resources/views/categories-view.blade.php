<x-librarian-layout>
    <!-- Categories Section -->
    <div class="flex justify-center w-full p-6">
        <div class="w-full md:w-2/3 bg-white border border-gray-200 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold text-gray-900 mb-6 text-center">Available Categories</h2>

            <!-- Categories Table -->
            <table class="min-w-full table-auto text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                    <tr>
                        <th scope="col" class="px-6 py-3 border-b">Category Name</th>
                        <th scope="col" class="px-6 py-3 border-b text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 border-b">
                                <span class="text-gray-900">{{ $item->name }}</span>
                            </td>
                            <td class="px-6 py-4 border-b text-center">
                                <!-- Action Buttons: Edit and Remove -->
                                <a href="{{ route('categories-edit', $item->id) }}" class="text-blue-600 hover:text-blue-800 font-medium">Edit</a>
                                <form action="{{ route('categories-delete', $item->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium ml-4">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-librarian-layout>

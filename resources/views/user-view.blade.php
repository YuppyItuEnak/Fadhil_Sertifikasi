<x-librarian-layout>

    <div class="flex flex-col gap-8 p-6">
        <!-- Books Section -->
        <div class="relative overflow-x-auto shadow-lg rounded-lg bg-white p-6">

            <h2 class="text-2xl font-semibold text-gray-900 mb-6 text-center">Books List</h2>

            <!-- Categories Table -->
            <table class="min-w-full border border-gray-200 text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                    <tr>
                        <th scope="col" class="px-6 py-3 border-b">Id</th>
                        <th scope="col" class="px-6 py-3 border-b">Name</th>
                        <th scope="col" class="px-6 py-3 border-b">Email</th>
                        <th scope="col" class="px-6 py-3 border-b">Phone</th>
                        <th scope="col" class="px-6 py-3 border-b">Role</th>
                        <th scope="col" class="px-6 py-3 border-b text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
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
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('register-edit', $user->id) }}"
                                    class="text-blue-600 hover:text-blue-800 font-medium transition-all duration-150">Edit</a>

                                <form action="{{ route('users-destroy', $user->id) }}" method="POST"
                                    class="inline-block ml-4">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-600 hover:text-red-800 font-medium transition-all duration-150">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>


</x-librarian-layout>

<x-librarian-layout>
    <form class="max-w-sm mx-auto" action="{{ route('categories-update', $categories->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- <input type="hidden" name="id" value="{{ $category->id }}"> --}}
        <div class="mb-5">
            <label for="Nama" class="block mb-2 text-sm font-medium text-gray-900">Masukan Nama Kategori</label>
            <input type="text" id="Nama" name="name"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{ $categories->name }}"
                placeholder="name@flowbite.com" required />
        </div>

        <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
    </form>

</x-librarian-layout>

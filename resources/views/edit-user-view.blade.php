<x-librarian-layout>
    <section class="bg-gray-50">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div class="w-full bg-white rounded-lg shadow border md:mt-0 sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                        Edit an account
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="{{ route('register-update', $user->id) }}" method="POST">
                        {{-- @dd($user) --}}

                        @csrf
                        @method('PUT')
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Your
                                Username</label>
                            <input type="text" name="name" id="name" value="{{ $user->name }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="name@company.com" required="">
                        </div>
                        @error('name')
                            <div>{{ $message }}</div>
                        @enderror

                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Your
                                email</label>
                            <input type="email" name="email" id="email" value="{{ $user->email }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="name@company.com" required="">
                        </div>
                        @error('email')
                            <div>{{ $message }}</div>
                        @enderror

                        <div>
                            <label for="phone" class="block mb-2 text-sm font-medium text-gray-900">Phone
                                Number</label>
                            <input type="text" name="phone" id="phone" value="{{ $user->phone }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                required="">
                        </div>
                        @error('phone')
                            <div>{{ $message }}</div>
                        @enderror

                        <div>
                            <label for="role" class="block mb-2 text-sm font-medium text-gray-900">Role</label>
                            <select name="role" id="role"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                required="">
                                <option value="member" {{ $user->role == 'member' ? 'selected' : '' }}>Member</option>
                                <option value="librarian" {{ $user->role == 'librarian' ? 'selected' : '' }}>Librarian</option>
                            </select>
                        </div>


                        @error('role')
                            <div class="text-sm text-red-600">{{ $message }}</div>
                        @enderror

                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                            <input type="password" name="password" id="password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                required="">
                        </div>
                        @error('password')
                            <div>{{ $message }}</div>
                        @enderror

                        <button type="submit"
                            class="w-full text-gray-900 bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Create
                            an account</button>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-librarian-layout>

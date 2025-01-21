<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between mb-4">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Users Detail') }}
            </h2>
        </div>
    </x-slot>
    <div class="flex gap-4">
        <div class="w-1/3 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="flex justify-end px-4 pt-4">
                <button id="dropdownButton" data-dropdown-toggle="dropdown"
                    class="inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5"
                    type="button">
                    <span class="sr-only">Open dropdown</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 16 3">
                        <path
                            d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                    </svg>
                </button>
                <!-- Dropdown menu -->
                <div id="dropdown"
                    class="z-10 hidden text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    <ul class="py-2" aria-labelledby="dropdownButton">
                        <li class="w-full">
                            <a href="{{ route('admin.users.edit', $user->id) }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white w-full text-center">Edit</a>
                        </li>
                        <li class="w-full">
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="w-full"
                                onsubmit="return confirm('Are you sure you want to delete this user?');">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{ $user->id }}">
                                <button type="submit"
                                    class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white w-full"
                                    onclick="return confirm('Are You sure?')">Delete</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="flex flex-col items-center pb-10">
                <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="{{ Storage::url($user->profile_picture) }}"
                    alt="{{ $user->username }} image" />
                <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ $user->username }}</h5>
                <span class="text-sm text-gray-500 dark:text-gray-400">{{ $user->role == 0 ? 'Admin' : 'User' }}</span>
                <div class="mt-4 md:mt-6">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Email: {{ $user->email }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Age: {{ $user->age }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Height: {{ $user->height }}cm</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Gender:
                        {{ $user->gender == 0 ? 'Male' : 'Female' }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Mobile Phone: {{ $user->mobile_phone }}</p>
                </div>
            </div>
        </div>
        <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1 w-full">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                No
                            </th>
                            <th scope="col" class="px-6 py-3">
                                User ID
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Price
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Duration
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Available
                            </th>
                            {{-- <th scope="col" class="px-6 py-3">
                                Actions
                            </th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($userPackages as $item)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $loop->iteration }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $item->User->username }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->price }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->duration }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->available ? 'Yes' : 'No' }}
                                </td>
                                {{-- <td class="flex gap-2">
                                    <x-button href="{{ route('admin.items.show', $item->id) }}">
                                        Detail
                                    </x-button>
                                    <x-button variant="warning" href="{{ route('admin.users.edit', $item->id) }}">
                                        Edit
                                    </x-button>
                                    <form action="{{ route('admin.items.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <x-button variant="danger" onclick="return confirm('Are you sure?')">
                                            Delete
                                        </x-button>
                                    </form>
                                </td> --}}
                            </tr>
                        @empty
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    No Data
                                </th>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

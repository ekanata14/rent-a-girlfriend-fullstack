<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:items-center md:justify-center">
            <h2 class="text-xl font-semibold leading-tight">
                Welcome {{ auth()->user()->username }}
            </h2>
            @if ($search)
                <h3 class="text-md font-semibold leading-tight">
                    Search: {{ $search }}
                </h3>
            @endif
        </div>
    </x-slot>

    <form class="max-w-md mx-auto" action="{{ route('client.dashboard.search') }}" method="POST">
        @csrf
        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <input type="search" id="default-search"
                class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Search Users" name="search" required />
            <button type="submit"
                class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
        </div>
    </form>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 xl:grid-cols-4 gap-4 mt-6">
        @forelse ($users as $user)
            <div
                class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 text-center">
                <div href="#" class="flex justify-center h-[200px]">
                    <img class="rounded-t-lg h-full" src="{{ Storage::url($user->profile_picture) }}"
                        alt="{{ $user->username }}" />
                </div>
                <div class="p-5">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            {{ $user->username }}</h5>
                    </a>
                    <div class="flex justify-center mb-2">
                        @if ($user->sum_ratings == '0' && $user->total_ratings == 0)
                            <p class="mr-1 text-sm font-normal text-gray-700 dark:text-gray-400">
                                Haven't rated yet</p>
                        @else
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $user->sum_ratings / $user->total_ratings)
                                    <svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor"
                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.37 2.448a1 1 0 00-.364 1.118l1.287 3.957c.3.921-.755 1.688-1.54 1.118l-3.37-2.448a1 1 0 00-1.175 0l-3.37 2.448c-.784.57-1.84-.197-1.54-1.118l1.287-3.957a1 1 0 00-.364-1.118L2.05 9.384c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69l1.286-3.957z">
                                        </path>
                                    </svg>
                                @else
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-300 dark:text-gray-500"
                                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.37 2.448a1 1 0 00-.364 1.118l1.287 3.957c.3.921-.755 1.688-1.54 1.118l-3.37-2.448a1 1 0 00-1.175 0l-3.37 2.448c-.784.57-1.84-.197-1.54-1.118l1.287-3.957a1 1 0 00-.364-1.118L2.05 9.384c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69l1.286-3.957z">
                                        </path>
                                    </svg>
                                @endif
                            @endfor
                        @endif
                    </div>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Age: {{ $user->age }}</p>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Height: {{ $user->height }}</p>
                    <a href="{{ route('client.users.show', $user->id) }}""
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        View Profile
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </a>
                </div>
            </div>
        @empty
            <p class="p-5 font-normal text-gray-700 dark:text-gray-400 col-span-4 text-center">No users found.</p>
        @endforelse
    </div>
</x-app-layout>

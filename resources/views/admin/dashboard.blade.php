<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </div>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1 mb-4">
        Welcome {{ auth()->user()->username }}
    </div>

    <div class="w-full flex flex-col md:flex-row gap-4">
        <a href="#"
            class="block w-full p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 text-center md:text-start">

            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $usersCount }}</h5>
            <p class="font-normal text-gray-700 dark:text-gray-400">Users</p>
        </a>

        <a href="#"
            class="block w-full p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 text-center md:text-start">

            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $ordersCount }}</h5>
            <p class="font-normal text-gray-700 dark:text-gray-400">Orders</p>
        </a>

    </div>

</x-app-layout>

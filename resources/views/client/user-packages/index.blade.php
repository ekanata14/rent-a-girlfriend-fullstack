<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between mb-4">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('User Packages') }}
            </h2>
        </div>
        <x-button href="{{ route('client.user-packages.create') }}">
            Create Package
        </x-button>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3">
                            User
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Title
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
                        <th scope="col" class="px-6 py-3">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($userPackages as $package)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $loop->iteration }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $package->user->username }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $package->title }}
                            </td>
                            <td class="px-6 py-4">
                                IDR {{ number_format($package->price, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $package->duration }} Hour(s)
                            </td>
                            <td class="px-6 py-4">
                                {{ $package->available ? 'Yes' : 'No' }}
                            </td>
                            <td class="flex gap-2">
                                <x-button variant="warning" href="{{ route('client.user-packages.edit', $package->id) }}">
                                    Edit
                                </x-button>
                                <form action="{{ route('client.user-packages.destroy') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="id" value="{{ $package->id }}">
                                    <x-button variant="danger" onclick="return confirm('Are you sure?')">
                                        Delete
                                    </x-button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>

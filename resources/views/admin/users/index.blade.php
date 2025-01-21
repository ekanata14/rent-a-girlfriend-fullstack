<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between mb-4">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Users') }}
            </h2>
        </div>
        <x-button href="{{ route('admin.users.create') }}">
            Create User
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
                            Username
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Age
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Height
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Role
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Gender
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Mobile Phone
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $loop->iteration }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $user->username }}
                                </th>
                            <td class="px-6 py-4">
                                {{ $user->email }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $user->age }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $user->height }}
                            </td>
                            <td class="px-6 py-4">
                                @if ($user->role == 0)
                                    <span class="text-green-500">admin</span>
                                @elseif($user->role == 1)
                                    <span>User</span>
                                @else
                                    <span>{{ $user->role }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if ($user->gender == 0)
                                    <span class="text-blue-500">Male</span>
                                @elseif($user->gender == 1)
                                    <span class="text-pink-500">Female</span>
                                @else
                                    <span>{{ $user->gender }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                {{ $user->mobile_phone }}
                            </td>
                            <td class="flex gap-2">
                                <x-button href="{{ route('admin.users.show', $user->id) }}">
                                    Detail
                                </x-button>
                                <x-button variant="warning" href="{{ route('admin.users.edit', $user->id) }}">
                                    Edit
                                </x-button>
                                <form action="{{ route('admin.users.destroy') }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="id" value="{{ $user->id }}">
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

    </div>
</x-app-layout>

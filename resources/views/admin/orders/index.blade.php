<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between mb-4">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Orders') }}
            </h2>
        </div>
        <x-button href="{{ route('admin.orders.create') }}">
            Create Order
        </x-button>
    </x-slot>

    <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Package ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            User ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Total Price
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $order->id }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $order->package_id }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $order->user_id }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $order->total_price }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $order->status }}
                            </td>
                            <td class="flex gap-2">
                                <x-button href="{{ route('admin.orders.show', $order->id) }}">
                                    Detail
                                </x-button>
                                <x-button variant="warning" href="{{ route('admin.orders.edit', $order->id) }}">
                                    Edit
                                </x-button>
                                <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
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

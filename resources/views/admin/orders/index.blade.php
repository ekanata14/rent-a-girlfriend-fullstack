<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between mb-4">
            <h2 class="text-xl font-semibold leading-tight">
                {{ __('Orders') }}
            </h2>
        </div>
        {{-- <x-button href="{{ route('admin.orders.create') }}">
            Create Order
        </x-button> --}}
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
                            Package ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            User
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Order By
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Total Price
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Payment Receipt
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Date
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Rating
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Review
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
                                {{ $loop->iteration }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $order->package->title }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $order->package->user->username }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $order->user->username }}
                            </td>
                            <td class="px-6 py-4"> IDR {{ number_format($order->total_price, 0, ',', '.') }} </td>
                            <td class="px-6 py-4">
                                <x-button variant="info" href="{{ asset('storage/' . $order->payment_receipt) }}"
                                    target="_blank">
                                    View
                                </x-button>
                            </td>
                            <td class="px-6 py-4">
                                {{ $order->date }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $order->status }}
                            </td>
                            <td class="px-6 py-4">
                                @if ($order->status == 'finished' && $order->rating != null)
                                    {{ $order->rating->rate }}/5
                                @else
                                    Haven't rated yet
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if ($order->status == 'finished' && $order->rating != null)
                                    {{ $order->rating->review }}
                                @else
                                    Haven't reviewed yet
                                @endif
                            </td>
                            <td class="flex gap-2">
                                @if (auth()->user()->role == 1 && $order->package->user_id == auth()->user()->id)
                                    @if ($order->status == 'pending' || $order->status == 'rejected')
                                        <form action="{{ route('client.orders.accept') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $order->id }}">
                                            <x-button type="submit" onclick="return confirm('Are you sure?')">
                                                Accept
                                            </x-button>
                                        </form>
                                    @endif
                                    @if ($order->status == 'pending')
                                        <form action="{{ route('client.orders.reject') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $order->id }}">
                                            <x-button variant="danger" type="submit"
                                                onclick="return confirm('Are you sure?')">
                                                Reject
                                            </x-button>
                                        </form>
                                    @endif
                                    @if ($order->status == 'accepted')
                                        <form action="{{ route('client.orders.finish') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $order->id }}">
                                            <x-button variant="success" type="submit"
                                                onclick="return confirm('Are you sure?')">
                                                Finish
                                            </x-button>
                                        </form>
                                    @endif
                                    {{-- <x-button variant="info" type="submit" onclick="return confirm('Are you sure?')">
                                        Chat {{ $order->user->username }}
                                    </x-button> --}}
                                @endif
                                @if (auth()->user()->role == 1 && $order->package->user_id != auth()->user()->id)
                                    @if ($order->status == 'finished' && $order->rating == null)
                                        <x-button variant="warning"
                                            href="{{ route('client.ratings.create', $order->id) }}">
                                            Rating
                                        </x-button>
                                    @endif
                                    <x-button variant="info" type="submit" onclick="return confirm('Are you sure?')">
                                        Chat {{ $order->package->user->username }}
                                    </x-button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>

@extends('admin.layout')

@section('content')
<div class="container mx-auto py-10">
    <h1 class="text-3xl font-bold mb-6">Customer Reservations</h1>

    <table class="w-full bg-white border border-gray-300 shadow-md rounded-lg">
        <thead class="bg-gray-100 border-b border-gray-300">
            <tr>
                <th class="py-3 px-4 text-left text-gray-600 font-medium">Customer</th>
                <th class="py-3 px-4 text-left text-gray-600 font-medium">Restaurant</th>
                <th class="py-3 px-4 text-left text-gray-600 font-medium">Table</th>
                <th class="py-3 px-4 text-left text-gray-600 font-medium">Reservation Time</th>
                <th class="py-3 px-4 text-left text-gray-600 font-medium">Status</th>
                <th class="py-3 px-4 text-center text-gray-600 font-medium">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reservations as $reservation)
                <tr class="border-b border-gray-200">
                    <td class="py-3 px-4">{{ $reservation->customer->name }}</td>
                    <td class="py-3 px-4">{{ $reservation->restaurant->name }}</td>
                    <td class="py-3 px-4">Table #{{ $reservation->table->number }}</td>
                    <td class="py-3 px-4">{{ $reservation->reservation_time }}</td>
                    <td class="py-3 px-4">
                        @if($reservation->status === 'pending')
                            <span class="text-yellow-500 font-semibold">Pending</span>
                        @elseif($reservation->status === 'confirmed')
                            <span class="text-green-500 font-semibold">Confirmed</span>
                        @else
                            <span class="text-red-500 font-semibold">Rejected</span>
                        @endif
                    </td>
                    <td class="py-3 px-4 flex space-x-2 justify-center">
                        @if($reservation->status === 'pending')
                            <form action="{{ route('admin.reservations.approve', $reservation->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-green-500 text-white py-1 px-3 rounded hover:bg-green-600">
                                    Accept
                                </button>
                            </form>
                            <form action="{{ route('admin.reservations.reject', $reservation->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600">
                                    Reject
                                </button>
                            </form>
                        @else
                            <span class="text-gray-500">No actions available</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-6 text-gray-600">No reservations found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

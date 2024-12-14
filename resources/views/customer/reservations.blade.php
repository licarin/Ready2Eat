@extends('customer.layout')

@section('content')
<div class="container mx-auto pt-20">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">My Reservations</h1>
    
    <div class="bg-white rounded-lg shadow-lg p-6">
        {{-- Display Validation Errors --}}
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                <strong class="font-bold">Oops!</strong>
                <span class="block sm:inline">There were some problems with your input:</span>
                <ul class="mt-2">
                    @foreach ($errors->all() as $error)
                        <li class="text-sm">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- No Reservations Placeholder --}}
        @if ($reservations->isEmpty())
            <div class="text-center py-10">
                <img src="{{ asset('images/no-reservations.png') }}" alt="No Reservations" class="w-40 mx-auto mb-4">
                <p class="text-gray-700 text-lg">You have no reservations yet. Start exploring and make one now!</p>
                <a href="{{ route('customer.restaurants.index') }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Browse Restaurants</a>
            </div>
        @else
            {{-- Reservations Table --}}
            <div class="overflow-x-auto">
                <table class="w-full table-auto border-collapse border border-gray-200 rounded-lg shadow">
                    <thead>
                        <tr class="bg-gray-100 border-b">
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Restaurant</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Table</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Reservation Time</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Guest Count</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Status</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reservations as $reservation)
                            <tr class="border-b hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-gray-800">{{ $reservation->restaurant->name }}</td>
                                <td class="px-6 py-4 text-gray-800">Table #{{ $reservation->table->number }}</td>
                                <td class="px-6 py-4 text-gray-800">{{ \Carbon\Carbon::parse($reservation->reservation_time)->format('M d, Y h:i A') }}</td>
                                <td class="px-6 py-4 text-gray-800">{{ $reservation->guest_count }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 text-sm rounded-full
                                        {{ $reservation->status == 'confirmed' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                                        {{ ucfirst($reservation->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if($reservation->status == 'pending')
                                        <a href="{{ route('customer.reservations.edit', $reservation->id) }}" class="text-blue-600 hover:underline">Edit</a>
                                        <form action="{{ route('customer.reservations.destroy', $reservation->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Are you sure you want to cancel this reservation?')">Cancel</button>
                                        </form>
                                    @else
                                        <span class="text-gray-400">Actions disabled</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection

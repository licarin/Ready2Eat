@extends('customer.layout')

@section('content')
<div class="container mx-auto pt-20">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Reservation</h1>

    <form action="{{ route('customer.reservations.update', $reservation->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="reservation_time" class="block text-sm font-medium text-gray-700">Reservation Time</label>
            <input 
                type="datetime-local" 
                name="reservation_time" 
                id="reservation_time" 
                class="w-full border-gray-300 rounded-lg shadow-sm"
                value="{{ \Carbon\Carbon::parse($reservation->reservation_time)->format('Y-m-d\TH:i') }}" 
                required>
        </div>

        <div class="mb-4">
            <label for="guest_count" class="block text-sm font-medium text-gray-700">Number of Guests</label>
            <input 
                type="number" 
                name="guest_count" 
                id="guest_count" 
                class="w-full border-gray-300 rounded-lg shadow-sm"
                value="{{ $reservation->guest_count }}" 
                min="1" 
                required>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-600">
            Update Reservation
        </button>
    </form>
</div>
@endsection

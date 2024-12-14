@extends('customer.layout')

@section('content')
<div class="container mx-auto pt-20">
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
        <!-- Restaurant Image -->
        <img src="{{ $restaurant->photos }}" alt="{{ $restaurant->name }}" class="w-full h-60 object-cover">

        <!-- Restaurant Details -->
        <div class="p-6">
            <h1 class="text-3xl font-bold text-gray-800">{{ $restaurant->name }}</h1>
            <p class="mt-4 text-gray-700">{{ $restaurant->description }}</p>
            <p class="mt-4 text-gray-600">
                <strong>Location:</strong> {{ $restaurant->location }}
            </p>
            <p class="mt-2 text-gray-600">
                <strong>Average Price:</strong> ${{ number_format($restaurant->average_price, 2) }}
            </p>
        </div>

        <!-- Reservation Section -->
        <div class="p-6 border-t border-gray-200 bg-gray-50">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Make a Reservation</h2>

            <!-- Display Validation Errors -->
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('customer.reservations.store') }}" method="POST">
                @csrf
                <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
                <input type="hidden" name="customer_id" value="{{ session('id') }}">

                <!-- Table Selection -->
                <div class="mb-4">
                    <label for="table_id" class="block text-sm font-medium text-gray-700">Select Table</label>
                    <select name="table_id" id="table_id" class="w-full border-gray-300 rounded-lg shadow-sm">
                        @foreach ($restaurant->tables as $table)
                            @php
                                $isReserved = $table->reservations()
                                    ->where('reservation_time', request('reservation_time'))
                                    ->where('status', 'confirmed')
                                    ->exists();
                            @endphp
                            <option value="{{ $table->id }}" {{ $isReserved ? 'disabled' : '' }}>
                                Table #{{ $table->number }} (Seats: {{ $table->seats }}) {{ $isReserved ? '(Reserved)' : '' }}
                            </option>
                        @endforeach
                    </select>

                </div>

                
                <div class="mb-4">
                    <label for="reservation_time" class="block text-sm font-medium text-gray-700">Reservation Time</label>
                    <input 
                        type="datetime-local" 
                        name="reservation_time" 
                        id="reservation_time" 
                        class="w-full border-gray-300 rounded-lg shadow-sm"
                        value="{{ old('reservation_time') }}" 
                        required>
                </div>

                
                <div class="mb-4">
                    <label for="guest_count" class="block text-sm font-medium text-gray-700">Number of Guests</label>
                    <input 
                        type="number" 
                        name="guest_count" 
                        id="guest_count" 
                        class="w-full border-gray-300 rounded-lg shadow-sm"
                        value="{{ old('guest_count') }}" 
                        min="1" 
                        required>
                </div>

                
                <div class="flex items-center gap-4 mt-6">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-600">
                        Reserve
                    </button>
                    <a href="{{ route('customer.reservations') }}" 
                       class="bg-gray-300 text-gray-800 px-4 py-2 rounded-lg shadow-md hover:bg-gray-400">
                        View My Reservations
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

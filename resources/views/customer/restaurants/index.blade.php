@extends('customer.layout')

@section('content')
<div class="container mx-auto pt-20">
    <h1 class="text-3xl font-bold mb-6">Search Restaurants</h1>
    <form action="{{ route('customer.restaurants.search') }}" method="GET" class="mb-6 flex space-x-4">
        <input type="text" name="location" placeholder="Location" class="border rounded p-2 w-full">
        <select name="price_range" class="border rounded p-2 w-full">
            <option value="">Select Price Range</option>
            <option value="0-50">0 - 50</option>
            <option value="50-100">50 - 100</option>
            <option value="100-200">100 - 200</option>
        </select>
        <button type="submit" class="bg-[var(--primary)] text-white px-4 py-2 rounded">Search</button>
    </form>

    <h2 class="text-2xl font-bold mb-6">Restaurants</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($restaurants as $restaurant)
            <div class="border rounded-lg shadow-lg overflow-hidden">
                <img src="{{ asset('storage/' . $restaurant->photos) }}" alt="{{ $restaurant->name }}" class="w-full h-40 object-cover">
                <div class="p-4">
                    <h2 class="text-xl font-bold">{{ $restaurant->name }}</h2>
                    <p class="text-gray-700">{{ $restaurant->description }}</p>
                    <a href="{{ route('customer.restaurants.show', $restaurant->id) }}"
                        class="text-[var(--primary)] font-medium mt-2 inline-block">View Details</a>
                </div>
            </div>
        @endforeach
    </div>
    <div class="mt-6">
    </div>
</div>
@endsection

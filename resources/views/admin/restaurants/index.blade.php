@extends('admin.layout')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Restaurants</h1>

    <!-- Tombol Tambah Restoran -->
    <div class="flex justify-between items-center mb-4">
        <a href="{{ route('admin.restaurants.create') }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Add New Restaurant</a>
        
        <!-- Form Pencarian dan Filter -->
        <form action="{{ route('admin.restaurants') }}" method="GET" class="flex items-center gap-2">
            <input type="text" name="search" placeholder="Search by name" value="{{ request('search') }}" class="border p-2 rounded">
            <input type="text" name="location" placeholder="Filter by location" value="{{ request('location') }}" class="border p-2 rounded">
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Search</button>
        </form>
    </div>

    <!-- Tabel Restoran -->
    <table class="w-full bg-white shadow-md rounded">
        <thead>
            <tr class="bg-gray-200 text-left">
                <th class="px-4 py-2">Photo</th>
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Location</th>
                <th class="px-4 py-2">Average Price</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($restaurants as $restaurant)
            <tr class="hover:bg-gray-100">
                <td class="px-4 py-2">
                    @if($restaurant->photos)
                        <img src="{{ Storage::url($restaurant->photos) }}" alt="Restaurant Photo" class="h-20 w-20 object-cover rounded">
                    @else
                        <span class="text-gray-500">No Image</span>
                    @endif
                </td>
                <td class="px-4 py-2 font-bold">
                    <a href="{{ route('admin.restaurants.show', $restaurant->id) }}" class="text-blue-500 hover:underline">{{ $restaurant->name }}</a>
                </td>
                <td class="px-4 py-2">{{ $restaurant->location }}</td>
                <td class="px-4 py-2">${{ $restaurant->average_price }}</td>
                <td class="px-4 py-2 flex gap-2">
                    <a href="{{ route('admin.restaurants.edit', $restaurant->id) }}" class="text-blue-500 hover:underline">Edit</a>
                    <form action="{{ route('admin.restaurants.destroy', $restaurant->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline">Delete</button>
                    </form>
                    <a href="{{ route('admin.reservations.index', ['restaurant_id' => $restaurant->id]) }}" class="text-green-500 hover:underline">Reservations</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center py-4">No restaurants found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="mt-4">
    
    </div>
</div>
@endsection

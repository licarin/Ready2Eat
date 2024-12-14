@extends('admin.layout')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Add New Table for {{ $restaurant->name }}</h1>

    <form action="{{ route('admin.tables.store', $restaurant->id) }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="number" class="block text-gray-700 font-bold">Table Number</label>
            <input type="number" name="number" id="number" class="border p-2 rounded w-full" value="{{ old('number') }}" required>
            @error('number')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="seats" class="block text-gray-700 font-bold">Seats</label>
            <input type="number" name="seats" id="seats" class="border p-2 rounded w-full" value="{{ old('seats') }}" required>
            @error('seats')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex gap-4">
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Save</button>
            <a href="{{ route('admin.restaurants.show', $restaurant->id) }}" class="bg-gray-500 text-white py-2 px-4 rounded">Cancel</a>
        </div>
    </form>
</div>
@endsection

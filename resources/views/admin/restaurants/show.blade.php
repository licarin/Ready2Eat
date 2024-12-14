@extends('admin.layout')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">{{ $restaurant->name }}</h1>

    <div class="mb-4">
        <a href="{{ route('admin.tables.create', $restaurant->id) }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Add New Table</a>
        <a href="{{ route('admin.reservations.index', ['restaurant_id' => $restaurant->id]) }}" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600 ml-2">View Reservations</a>
    </div>

    <div class="mt-4">
        <h2 class="text-xl font-bold mb-4">Tables</h2>
        <table class="w-full bg-white shadow-md rounded">
            <thead>
                <tr class="bg-gray-200 text-left">
                    <th class="px-4 py-2">Table Number</th>
                    <th class="px-4 py-2">Seats</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($restaurant->tables as $table)
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-2">{{ $table->number }}</td>
                    <td class="px-4 py-2">{{ $table->seats }}</td>
                    <td class="px-4 py-2">
                        @if($table->is_full)
                            <span class="text-red-500">Full</span>
                        @else
                            <span class="text-green-500">Available</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 flex gap-2">
                        <a href="{{ route('admin.tables.edit', $table->id) }}" class="text-blue-500 hover:underline">Edit</a>
                        <form action="{{ route('admin.tables.delete', $table->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4">No tables found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

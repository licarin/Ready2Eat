@extends('admin.layout')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Edit Restaurant</h1>
    <form action="{{ route('admin.restaurants.update', $restaurant->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.restaurants.partials.form', ['restaurant' => $restaurant])
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Update</button>
    </form>
</div>
@endsection

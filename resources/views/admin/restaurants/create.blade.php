@extends('admin.layout')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Add Restaurant</h1>
    <form action="{{ route('admin.restaurants.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.restaurants.partials.form')
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Save</button>
    </form>
</div>
@endsection

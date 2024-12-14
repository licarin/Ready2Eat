{{-- register.blade.php --}}
@extends('customer.layout')

@section('page-content')
<div class="w-full max-w-sm mx-auto bg-white p-8 shadow-md rounded-lg">
    <h2 class="text-2xl font-bold text-center mb-4">Register</h2>
    @if (session()->has('error'))
        <div class="text-red-500 text-sm mb-4 text-center">{{ session('error') }}</div>
    @endif
    <form action="{{ route('register') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label for="name" class="block text-gray-700">Full Name</label>
            <input type="text" name="name" id="name" required
                class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Enter full name">
        </div>
        <div>
            <label for="email" class="block text-gray-700">Email</label>
            <input type="email" name="email" id="email" required
                class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Enter email">
        </div>
        <div>
            <label for="password" class="block text-gray-700">Password</label>
            <input type="password" name="password" id="password" required
                class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Enter password">
        </div>
        <button type="submit"
            class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg transition">Register</button>
    </form>
</div>
@endsection

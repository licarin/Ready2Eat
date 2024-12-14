<nav class="bg-white shadow-md fixed w-full z-50">
    <div class="container mx-auto flex justify-between items-center py-4 px-6">
        <a href="{{ route('home') }}" class="text-xl font-bold text-[var(--primary)]">
            Taste Connect
        </a>
        <ul class="flex space-x-6">
            <li><a href="{{ route('restaurants.index') }}" class="text-gray-700 hover:text-[var(--primary)]">Restaurants</a></li>
            <li><a href="{{ route('reservations.index') }}" class="text-gray-700 hover:text-[var(--primary)]">My Reservations</a></li>
        </ul>
        <div class="flex items-center space-x-4">
            <span class="text-gray-700">Welcome, {{ session('user_name') }}</span>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Logout</button>
            </form>
        </div>
    </div>
</nav>

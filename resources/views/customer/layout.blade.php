<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ready2Eat</title>

    <!-- Tailwind CSS & tambahan CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    
    @yield('head')
</head>

<body class="bg-gray-50">

    <!-- Navbar -->
    <nav class="bg-white shadow-md py-4">
        <div class="container mx-auto px-6 flex justify-between items-center">
            <a href="{{ route('customer.index') }}" class="text-lg font-bold text-gray-700">Ready2Eat</a>
            <div>
                @if (auth()->check())
                    <a href=""
                        class="px-4 py-2 text-sm bg-red-500 text-white rounded hover:bg-red-700 transition">Logout</a>
                @else
                    <a href="{{ route('customer.login') }}"
                        class="px-4 py-2 text-sm bg-blue-500 text-white rounded hover:bg-blue-700 transition">Login</a>
                    <a href=""
                        class="px-4 py-2 text-sm bg-green-500 text-white rounded hover:bg-green-700 transition">Register</a>
                @endif
            </div>
        </div>
    </nav>

    <!-- Konten Utama -->
    <main class="container mx-auto px-6 py-8">
        @yield('content')
    </main>

    @yield('scripts')
</body>

</html>

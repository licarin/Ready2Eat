<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ready2Eat Admin</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/tw-elements.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/css/tw-elements.min.css" />
    <script src="https://cdn.tailwindcss.com/3.3.0"></script>

    {{-- CDN for JQUERY --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    {{-- FontAwesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    {{-- Swiper --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    {{-- CDN for SweetAlert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- AOS --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');

        * {
            font-family: 'Inter', sans-serif;
            box-sizing: border-box;
            padding: 0;
            margin: 0;
        }

        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
        }

        :root {
            --primary: #d35400; /* Warna utama untuk Ready2Eat */
            --secondary: #e67e22;
            --contrast: #d35400;
            --lighten: rgba(211, 84, 0, 0.25);
        }

        .swal2-confirm {
            background: var(--primary) !important;
        }

        .swal2-deny,
        .swal2-cancel {
            background: rgb(242, 73, 73) !important;
        }

        body {
            overflow-x: hidden;
        }
    </style>

    @yield('head')
</head>

<body>
    @include('admin.navbar')

    <div class="toast fixed bottom-0 right-[-100vw] p-8 z-[11000] transition-all duration-300">
        <div class="w-[400px] h-fit bg-green-100 rounded">
            <h2 class="toast-title font-bold text-green-700 text-lg px-4 py-2 w-full border-b-2 border-green-500"></h2>
            <p class="text-green-700 font-medium px-4 py-2 toast-text"></p>
        </div>
    </div>
    @yield('content')


    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/js/tw-elements.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/tw-elements.umd.min.js"></script>

    <script>
        AOS.init();

        function popToast(success, message) {
            const toast = document.querySelector('.toast');
            const toastTitle = toast.querySelector('.toast-title');
            const toastText = toast.querySelector('.toast-text');
            const toastContainer = toast.querySelector('div');

            if (success) {
                toastTitle.classList.remove('text-red-700');
                toastTitle.classList.add('text-green-700');
                toastText.classList.remove('text-red-700');
                toastText.classList.add('text-green-700');
                toastContainer.classList.remove('bg-red-100', 'border-red-500');
                toastContainer.classList.add('bg-green-100', 'border-green-500');
            } else {
                toastTitle.classList.remove('text-green-700');
                toastTitle.classList.add('text-red-700');
                toastText.classList.remove('text-green-700');
                toastText.classList.add('text-red-700');
                toastContainer.classList.remove('bg-green-100', 'border-green-500');
                toastContainer.classList.add('bg-red-100', 'border-red-500');
            }

            toastTitle.textContent = success ? 'Success' : 'Error';
            toastText.textContent = message;

            toast.style = 'right: 0';
            setTimeout(() => {
                toast.style = 'right: -100vw';
            }, 2300);
        }
    </script>

</body>

</html>
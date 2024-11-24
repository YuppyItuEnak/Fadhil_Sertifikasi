<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Layout</title>

    {{-- CSS --}}
    @yield('css')

    {{-- Vite JS & JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/navbar.js'])

</head>

<body>
    <header>
        <x-dashboard-navbar></x-dashboard-navbar>
    </header>

    <x-aside></x-aside>

    <main class="p-4 sm:ml-64">
        {{-- Content --}}
        <div class="p-4 mt-14">
            {{ $slot }}
        </div>
    </main>



    @yield('scripts')

    <script>
        function toggleMenu(menuId) {
            const menu = document.getElementById(menuId);
            if (menu.classList.contains('hidden')) {
                menu.classList.remove('hidden');
            } else {
                menu.classList.add('hidden');
            }
        }
    </script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventé | Premium Event Planning & Booking</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/png" href="{{ asset('event-schedule.png') }}">
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    @stack('styles')
</head>

<body class="bg-white text-gray-800">
    <!-- Navigation -->
    @include('include.header')

    <div id="app">
        @yield('content')
    </div>

    <!-- Footer -->
    @include('include.footer')

    @stack('scripts')

    <script>
        window.addEventListener('load', () => {
            if (window.app && typeof window.app.mount === 'function') {
                window.app.mount('#app');
            }
        });
    </script>
</body>

</html>

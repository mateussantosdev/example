<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/css/toast.css', 'resources/js/app.js'])
    @else
        @stack('styles')

        <head>
            <link href="{{ asset('css/tailwind.css') }}" rel="stylesheet">
        </head>
    @endif
</head>

<body class="bg-gray-100 text-gray-900 min-h-screen flex flex-col">

    
    {{-- Header --}}
    @yield('header')
    
    <div id="toast-container" class="fixed inset-0 flex items-start justify-center mt-10 pointer-events-none z-50"></div>

    {{-- Main --}}
    <main class="container mx-auto p-6 flex-grow">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-gray-800 text-white text-center p-4 mt-6">
        <p>&copy; {{ date('Y') }} {{ config('app.name') }}. Todos os direitos reservados.</p>
    </footer>

    @stack('scripts')
</body>

</html>


<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title', config('app.name', 'LPK Mirai Gresik'))
    </title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('LOGO_MIRAI.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link
        href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap"
        rel="stylesheet"
    >

    <!-- Bootstrap Icons (Temporary) -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

    <!-- Application Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Page Specific Styles -->
    @stack('styles')
</head>

<body class="min-h-screen bg-slate-50 font-sans antialiased text-slate-800">

    <div id="app" class="min-h-screen pt-16 lg:pl-64">

        <!-- Navigation -->
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="border-b border-slate-200 bg-white">
                <div class="mx-auto max-w-7xl px-4 py-5 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Main Content -->
        <main id="main-content" class="min-w-0">
            @yield('content')
        </main>

    </div>

    <!-- Global Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Page Specific Scripts -->
    @stack('scripts')

</body>
</html>

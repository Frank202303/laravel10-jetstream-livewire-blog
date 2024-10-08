<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])


    {{-- blade-ui-kit  Styles --}}
    @bukStyles(true)

    <!-- livewire Styles -->
    @livewireStyles

</head>

<body class="font-sans antialiased">
    <x-banner />

    <div class="min-h-screen bg-gray-100">

        {{-- app.blade.php
               Used by @livewire
                navigation-menu VIEW --}}
        @livewire('navigation-menu')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="flex px-4 py-6  mx-auto  space-x-8  max-w-7xl  sm:px-6 lg:px-8">
                    {{ $header }}
                    @if (isset($nav))
                        {{ $nav }}
                    @endif
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    @stack('modals')


    {{-- blade-ui-kit  --Scripts --}}
    @bukScripts(true)

    {{-- livewireScripts --}}
    @livewireScripts

</body>

</html>

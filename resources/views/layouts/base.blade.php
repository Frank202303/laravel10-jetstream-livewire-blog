<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <x-partials.head />
    <style>
        .gradient {
            background: linear-gradient(90deg, #d53369 0%, #daae51 100%);
        }
    </style>
</head>

<body class="leading-normal tracking-normal text-white gradient">
    <x-partials.nav />
    <x-ui.alerts />
    <div class="font-sans text-gray-900 antialiased">
        {{ $slot }}
    </div>
    <footer>
        <x-partials.footer />
    </footer>
    {{-- Add dependencies --}}
    @livewireScripts
</body>

</html>

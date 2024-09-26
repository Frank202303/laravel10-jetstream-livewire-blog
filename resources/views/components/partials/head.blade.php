<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="description" content="@yield('meta_description')" />
<meta name="keywords" content="" />

{{-- Facebook Meta --}}
{{-- URL image and title are required when sharing articles --}}
<meta property="og:url" content="{{ url()->current() }}" />
<meta property='og:image' content="{{ config('app.url') }}/@yield('og:image')">
<meta property='og:title' content="@yield('og:title')" />


<!-- Fonts -->
<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

<Script src="{{ asset('js/main.js') }}" defer></Script>
<Script src="{{ asset('js/drop-down.js') }}" defer></Script>
<!-- Scripts -->
@vite(['resources/css/app.css', 'resources/js/app.js'])

{{-- Public/shared modules need to be inserted here --}}
{{-- yield parent --}}
{{-- When inheriting from a child: use @section --}}
<title>@yield('title', 'Blog')</title>
{{-- Add dependencies --}}
@livewireStyles

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

{{-- Facebook Meta --}}
{{-- 分享文章时需要  url image 和 title --}}
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

{{-- 在这里需要插入公共/共用模块 --}}
<title>@yield('title', 'Blog')</title>
{{-- 添加依赖 --}}
@livewireStyles

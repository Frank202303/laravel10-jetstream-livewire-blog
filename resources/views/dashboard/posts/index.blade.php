<x-app-layout>
    {{-- 这是 header slot --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- 这是 nav slot --}}
            {{ __('Posts') }}
        </h2>
    </x-slot>

    {{-- important nav info --}}
    <x-slot name="nav">
        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
            {{-- Index --}}
            <x-nav-link href="{{ route('posts.index') }}" :active="request()->routeIs('posts.index')">
                {{ __('Index') }}
            </x-nav-link>
            {{-- Create --}}
            <x-nav-link href="{{ route('posts.create') }}" :active="request()->routeIs('posts.create')">
                {{ __('Create') }}
            </x-nav-link>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
        <x-ui.alerts />
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                {{-- FF-这个是Index.php的路径 --}}
                {{-- FF-这个是Index.php的路径 --}}
                <livewire:post.index>
            </div>
        </div>
    </div>
</x-app-layout>

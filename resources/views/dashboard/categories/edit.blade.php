<x-app-layout>
    {{-- 这是 header slot --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- 这是 nav slot --}}
            {{ __('Categories') }}
        </h2>
    </x-slot>


    <x-slot name="nav">
        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
            {{-- Index --}}
            <x-nav-link href="{{ route('categories.index') }}" :active="request()->routeIs('categories.index')">
                {{ __('Index') }}
            </x-nav-link>
            {{-- Create --}}
            <x-nav-link href="{{ route('categories.create') }}" :active="request()->routeIs('categories.create')">
                {{ __('Create') }}
            </x-nav-link>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-4">
                    {{-- 向数据库更改数据 --}}
                    <form action="{{ route('categories.update', $category) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- 是child时，显示 select --}}
                        {{-- categories 是parent --}}

                        @if (!is_null($category->parent_id))
                            <div>
                                <small class="mb-4 text-gray-500 ">Please select parent only for subCategory</small>
                                <select name="parent_id" id="" class="block mt-1 w-full">
                                    @foreach ($categories as $categoryMain)
                                        <option value="{{ $categoryMain->id }}"
                                            {{ $categoryMain->id == $category->parent_id ? 'selected' : '' }}>
                                            {{ $categoryMain->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                        @endif

                        {{-- x-label在laravel8和9版本，
                    使用jetStream时，x-jet-label --}}
                        {{-- label.blade.php在components文件夹里。可以自定义 --}}
                        <div>
                            <x-label for="name" value="{{ __('Name') }}" />
                            {{-- syntax error, unexpected token "<" --}}
                            {{-- 为什么这里不用{{}} --}}
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                                :value="$category->name" required autofocus autocomplete="name" />
                            <span class="mt-2 text-xs text-gray-400 ">Maximum 200 characters</span>
                            <x-input-error for='name' class='mt-2' />
                        </div>

                        {{-- margin top --}}
                        <x-button class="mt-12">
                            {{ __('Update') }}
                        </x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

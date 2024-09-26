<x-app-layout>
    {{-- This is a header slot --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- This is a nav slot --}}
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
                    {{-- Change data to the database --}}
                    <form action="{{ route('categories.update', $category) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- When it is child, display select --}}
                        {{-- categories is parent --}}

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

                        {{-- x-label in laravel 8 and 9 versions,
                            when using jetStream, x-jet-label --}}
                        {{-- label.blade.php is in the components folder. Can be customized --}}
                        <div>
                            <x-label for="name" value="{{ __('Name') }}" />
                            {{-- syntax error, unexpected token "<" --}}
                            {{-- Why not use {{}} here --}}
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

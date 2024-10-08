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
                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf

                        <div>
                            <small class="mb-4 text-gray-500"> Note: Select Parent only for subcategory</small>
                            <select name="parent_id" id="" class="w-full mb-6 bg-indigo-200 border-none">
                                <option value="">Select Parent Category</option>
                                {{-- Call to undefined relationship [categories] on model [App\Models\Category]. --}}
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- x-label in laravel 8 and 9 versions,
                            when using jetStream, x-jet-label --}}
                        {{-- label.blade.php is in the components folder. Can be customized --}}
                        <div>
                            <x-label for="name" value="{{ __('Name') }}" />
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                                :value="old('name')" required autofocus autocomplete="name" />
                            <span class="mt-2 text-xs text-gray-400 ">Maximum 200 characters</span>
                            <x-input-error for='name' class='mt-2' />
                        </div>

                        {{-- margin top --}}
                        <x-button class="mt-12">
                            {{ __('Create') }}
                        </x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

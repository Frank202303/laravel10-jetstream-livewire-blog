<x-app-layout>
    {{--   header slot --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{--   nav slot --}}
            {{ __('Tags') }}
        </h2>
    </x-slot>


    <x-slot name="nav">
        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
            {{-- Index --}}
            <x-nav-link href="{{ route('tags.index') }}" :active="request()->routeIs('tags.index')">
                {{ __('Index') }}
            </x-nav-link>
            {{-- Create --}}
            <x-nav-link href="{{ route('tags.create') }}" :active="request()->routeIs('tags.create')">
                {{ __('Create') }}
            </x-nav-link>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-4">
                    <form action="{{ route('tags.store') }}" method="POST">
                        @csrf


                        {{-- x-label in laravel 8 and 9 versions,
when using jetStream, x-jet-label --}}
                        {{-- label.blade.php is in the components folder. Can be customized --}}
                        <div>
                            <x-label for="name" value="{{ __('Name') }}" />
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                                :value="old('name')" required autofocus autocomplete="name" />
                            <span class="mt-2 text-xs text-gray-400 ">Maximum 200 characters</span>
                            <x-input-error for='name' class='mt-2'>

                            </x-input-error>
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

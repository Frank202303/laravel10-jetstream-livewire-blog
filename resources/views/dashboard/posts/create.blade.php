<x-app-layout>
    {{-- 这是 header slot --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- 这是 nav slot --}}
            {{ __('Posts') }}
        </h2>
    </x-slot>


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

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-4">
                    {{-- https://blade-ui-kit.com/docs/0.x/form --}}
                    <x-form action="{{ route('posts.store') }}" has-files>
                        {{-- x-label在laravel8和9版本，
                        使用jetStream时，x-jet-label --}}
                        {{-- label.blade.php在components文件夹里。可以自定义 --}}
                        <div class="space-y-6">
                            {{-- Cover Image --}}
                            <div>
                                <x-label for="cover_image" value="{{ __('Cover Image') }}" />
                                <input name="cover_image" id="cover_image" type="file">
                                <span class="mt-2 text-xs text-gray-400 ">File type: jpg, png only</span>
                                <x-input-error for='cover_image' class='mt-2' />
                            </div>

                            {{-- Title --}}
                            <div>
                                <x-label for="title" value="{{ __('Title') }}" />
                                <x-input id="title" class="block mt-1 w-full" type="text" name="title"
                                    :value="old('title')" required autofocus autocomplete="title" />
                                <span class="mt-2 text-xs text-gray-400 ">Maximum 200 characters</span>
                                <x-input-error for='title' class='mt-2' />
                            </div>

                            {{-- Categories --}}
                            <div>
                                <x-label for="category_id" value="{{ __('Categories') }}" />
                                <select name="category_id" id="category_id" class="block mt-1 w-full">
                                    <option value="">Please select a category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Body --}}
                            <div>
                                <x-label for="body" value="{{ __('Body') }}" />
                                <x-trix name='body' styling='overflow-y-scroll h-96'>
                                </x-trix>
                                <x-input-error for='body' class='mt-2' />
                            </div>

                            {{-- Schedule --}}
                            <div>
                                <x-label for="published_at" value="{{ __('Schedule Date') }}" />
                                <x-pikaday name="published_at" />
                            </div>

                            {{-- Tags --}}
                            <div>
                                <x-label for="tags[]" value="{{ __('Tags') }}" />
                            </div>


                            {{-- Meta description --}}
                            <div>
                                <x-label for="meta_description" value="{{ __('Meta description') }}" />
                                <x-trix name='meta_description' styling='overflow-y-scroll h-36'>
                                </x-trix>
                                <x-input-error for='meta_description' class='mt-2' />
                            </div>
                        </div>
                        {{-- margin top --}}
                        <x-button class="mt-12">
                            {{ __('Create') }}
                        </x-button>

                    </x-form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

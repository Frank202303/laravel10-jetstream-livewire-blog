<x-app-layout>
    {{--   header slot --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{--   nav slot --}}
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
                    <x-form method="PUT" action="{{ route('posts.update', $post) }}" has-files>
                        {{-- x-label in laravel 8 and 9 versions,
when using jetStream, x-jet-label --}}
                        {{-- label.blade.php is in the components folder. Can be customized --}}
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
                                    :value="$post->title" required autofocus autocomplete="title" />
                                <span class="mt-2 text-xs text-gray-400 ">Maximum 200 characters</span>
                                <x-input-error for='title' class='mt-2' />
                            </div>

                            {{-- Categories --}}
                            <div>
                                <x-label for="category_id" value="{{ __('Categories') }}" />
                                <select name="category_id" id="category_id" class="block mt-1 w-full">
                                    <option value="">Please select a category</option>
                                    @foreach ($categories as $category)
                                        {{-- should be $post->category_id --}}
                                        <option value="{{ $category->id }}"
                                            @if ($category->id == $post->category_id) selected @endif>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error for='category_id' class='mt-2' />
                            </div>

                            {{-- Body --}}
                            <div>
                                <x-label for="body" value="{{ __('Body') }}" />
                                <x-trix name='body' styling='overflow-y-scroll h-96'>
                                    {{ $post->body }}
                                </x-trix>
                                <x-input-error for='body' class='mt-2' />
                            </div>

                            {{-- Schedule --}}
                            <div>
                                <x-label for="published_at" value="{{ __('Schedule Date') }}" />
                                {{-- Invalid datetime format: 1292 Incorrect datetime value: '15/09/2023' for column `blog`.`posts`.`published_at` at row 1 --}}
                                <x-pikaday name="published_at" format='YYYY-MM-DD' value='{{ $post->published_at }}' />
                                <x-input-error for='published_at' class='mt-2' />
                            </div>





                            {{-- Meta description --}}
                            <div>
                                <x-label for="meta_description" value="{{ __('Meta description') }}" />
                                <x-trix name='meta_description' styling='overflow-y-scroll h-36'>
                                    {{ $post->meta_description }}
                                </x-trix>
                                <x-input-error for='meta_description' class='mt-2' />
                            </div>
                        </div>
                        {{-- margin top --}}
                        <x-button class="mt-12">
                            {{ __('Updated') }}
                        </x-button>

                    </x-form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

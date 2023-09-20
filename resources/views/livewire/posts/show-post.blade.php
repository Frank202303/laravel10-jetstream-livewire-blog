<div class="grid grid-cols-4 gap-8">
    {{-- Main Content --}}
    <div class="col-span-3">
        @foreach ($posts as $post)
            <div class="bg-indigo">
                POSTS
            </div>
        @endforeach
    </div>

    {{-- Side bar/Navigation --}}
    <div class="space-y-8">

        {{-- Sorting --}}
        <div class="flex items-center">
            <h2>Sort:</h2>
            <div class="space-x-4">
                <button wire:click='sortBy("recentAsc")'>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path
                            d="M9.97.97a.75.75 0 011.06 0l3 3a.75.75 0 01-1.06 1.06l-1.72-1.72v3.44h-1.5V3.31L8.03 5.03a.75.75 0 01-1.06-1.06l3-3zM9.75 6.75v6a.75.75 0 001.5 0v-6h3a3 3 0 013 3v7.5a3 3 0 01-3 3h-7.5a3 3 0 01-3-3v-7.5a3 3 0 013-3h3z" />
                        <path
                            d="M7.151 21.75a2.999 2.999 0 002.599 1.5h7.5a3 3 0 003-3v-7.5c0-1.11-.603-2.08-1.5-2.599v7.099a4.5 4.5 0 01-4.5 4.5H7.151z" />
                    </svg>

                </button>
                <button wire:click='sortBy("recentDesc")'>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path fill-rule="evenodd"
                            d="M9.75 6.75h-3a3 3 0 00-3 3v7.5a3 3 0 003 3h7.5a3 3 0 003-3v-7.5a3 3 0 00-3-3h-3V1.5a.75.75 0 00-1.5 0v5.25zm0 0h1.5v5.69l1.72-1.72a.75.75 0 111.06 1.06l-3 3a.75.75 0 01-1.06 0l-3-3a.75.75 0 111.06-1.06l1.72 1.72V6.75z"
                            clip-rule="evenodd" />
                        <path
                            d="M7.151 21.75a2.999 2.999 0 002.599 1.5h7.5a3 3 0 003-3v-7.5c0-1.11-.603-2.08-1.5-2.599v7.099a4.5 4.5 0 01-4.5 4.5H7.151z" />
                    </svg>

                </button>
            </div>

        </div>

        {{-- Categories --}}
        <div>
            <div class="p-2 text-white bg-indigo-500">
                <h2>Categories</h2>
                @foreach ($categories as $category)
                    <button wire:click='toggleCategory("{{ $category->id }}")'>
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>
        </div>
    </div>

</div>

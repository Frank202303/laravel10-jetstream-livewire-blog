{{-- 3000毫秒后，把open 设置 为false --}}

@if (session()->has('success'))
    <div x-data="{ open: true }" x-init="setTimeout(() => { open = false }, 3000)" x-show="open" enter="transition duration-500 transform ease-out"
        start="opacity-1" leave="transition duration-500 transform ease-in" leave-end="opacity-0"
        class="flex items-center p-2 mb-4 text-white bg-green-600 rounded">

        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="w-5 pt-1 mr-3">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span>
            {{ session('success') }}
        </span>

    </div>
@endif


@if (session()->has('error'))
    <div x-data="{ open: true }" x-init="setTimeout(() => { open = false }, 3000)" x-show="open"
        enter="transition duration-500 transform ease-out" start="opacity-1"
        leave="transition duration-500 transform ease-in" leave-end="opacity-0"
        class="flex items-center p-2 mb-4 text-white bg-red-600 rounded">

        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 pt-1 mr-3" fill="none" viewBox="0 0 24 24"
            stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
        </svg>

        <span>
            {{ session('error') }}
        </span>

    </div>
@endif

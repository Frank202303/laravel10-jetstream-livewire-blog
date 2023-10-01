<x-base-layout>

    {{-- Meta Description --}}
    {{-- 填 坑/插槽 --}}
    @section('meta_description', $post->metaDescriptionFormat())

    {{-- Facebook Meta --}}
    @section('og:title', $post->title)
    @section('og:image', 'storage/images/' . $post->cover_image)

    {{-- http://127.0.0.1:8000/storage/images/1694752428.3.jpg --}}

    {{-- Title --}}
    @section('title', $post->title)

    <main class="min-h-screen">

        <section class="container pt-24 mx-auto space-y-4">
            <article class="p-4 bg-white">
                <h1 class="text-2xl mb-2 font-bold">
                    {{ $post->title }}
                </h1>
                <div>
                    {!! $post->body !!}
                </div>

                <button class="p-2 mt-16 text-xs text-white bg-blue-500">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ Request::url() }}" target='_blank'>
                        Share On Facebook
                    </a>
                </button>
            </article>
        </section>

    </main>
</x-base-layout>

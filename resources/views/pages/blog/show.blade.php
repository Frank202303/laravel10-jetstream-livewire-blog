<x-base-layout>
    <main class="min-h-screen">

        <section class="container pt-24 mx-auto space-y-4">
            <article>
                <h1>
                    {{ $post->title }}
                </h1>
                <div>
                    {!! $post->body !!}
                </div>
            </article>
        </section>

    </main>
</x-base-layout>

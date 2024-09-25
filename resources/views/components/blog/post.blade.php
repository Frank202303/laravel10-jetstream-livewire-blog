<div class="p-2 bg-white shadow">
    <a href="{{ route('blog.show', $post) }}">
        <h2 class="text-xl font-bold">{{ $post->title }}</h2>

        <div>{{ Str::limit(strip_tags($post->body), 200, '...') }}</div>
    </a>
</div>

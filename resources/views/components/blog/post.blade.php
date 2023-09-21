<div class="p-2 bg-white shadow">
    <a href="#">
        <h2 class="text-xl font-bold">{{ $post->title }}</h2>
        <div>{!! Str::limit($post->body, 200, '...') !!}</div>
    </a>
</div>

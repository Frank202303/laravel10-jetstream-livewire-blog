<div>
    <!-- Rounded switch -->
    <label class="switch">
        {{-- 不需要 wire:click='toggleFeature' --}}
        <input wire:model='featured' type="checkbox" id="{{ $name . $post->id }}">
        <span class="slider round"></span>
    </label>
</div>

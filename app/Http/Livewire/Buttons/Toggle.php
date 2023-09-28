<?php

namespace App\Http\Livewire\Buttons;

use App\Models\Post;
use Livewire\Component;

class Toggle extends Component
{
    public bool $featured;
    public Post $post;
    public string $name;

    public function render()
    {
        return view('livewire.buttons.toggle');
    }

    public function mount()
    {
        //  不能这么写 $this->featured = $this->post->featured;
        $this->featured = $this->post->getAttribute('featured');
    }

    public function updating($name, $value)
    {
        $this->post->setAttribute($name, $value)->save();
    }

    // public function toggleFeature()
    // {
    // }
}

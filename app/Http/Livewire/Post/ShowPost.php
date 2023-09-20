<?php

namespace App\Http\Livewire\Post;

use App\Models\Category;
use Livewire\Component;

class ShowPost extends Component
{
    // public $posts = [1, 5, 6];
    public function render()
    {
        $posts = [1, 5, 6];
        $categories = Category::all();
        return view('livewire.posts.show-post', compact('posts', 'categories'));
    }

    public function sortBy($order)
    {
    }
    public function toggleCategory($categoryId)
    {
    }
}

<?php

namespace App\Http\Livewire\Post;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $orderBy = 'id';
    public $orderAsc = true;
    public $perPage = 10;

    public function render()
    {
        // Get the data by calling the searchPost method, then filter it, and finally paginate it.
        // Pass the obtained data to the view
        return view('livewire.posts.index', [
            'posts' => Post::searchPost($this->search)
                ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
                ->paginate($this->perPage)
        ]);
    }
}

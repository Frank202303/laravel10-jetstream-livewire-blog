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
        // 通过调用searchPost方法，得到数据，然后筛选，最后分页，
        //得到的数据，传递到view里
        return view('livewire.posts.index', [
            'posts' => Post::searchPost($this->search)
                ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
                ->paginate($this->perPage)
        ]);
    }
}

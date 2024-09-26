<?php

namespace App\Http\Livewire\Post;

use App\Models\Category;
use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class ShowPost extends Component
{
    use WithPagination;
    public $category;
    public $sortBy = 'recentDesc';
    // protected $querystring is a property in the Livewire component that defines URL query parameters.
    //This property is used to define how the Livewire component should handle URL query parameters when processing requests
    protected $querystring = [
        //'category' is the name of the query parameter, which represents the query parameter name in the URL.
        //['except' => '']: If the 'category' query parameter is not provided in the URL, Livewire will default it to an empty string.
        'category'        => ['except' => ''],
        'sortBy'          => ['except' => 'recentDesc'],
    ];

    public function render()
    {
        // use Local Scopes
        $posts = Post::published();;
        $categories = Category::all();

        if ($this->category) {
            // use Local Scopes
            $posts->category($this->category);
        }

        //?? $posts->recentDesc();
        $posts->{$this->sortBy}(); // ??

        return view(
            'livewire.posts.show-post',
            [
                'posts' => $posts->paginate(5),
                'categories' => $categories,
                'selectedCategory' => $this->category,
                'selectedSortBy' => $this->sortBy,
            ]

        );
    }

    public function sortBy($sort): void
    {

        // If it is a valid sort type, use it
        // Otherwise use the default value recentDesc
        $this->sortBy =
            $this->validSort($sort) ? $sort : 'recentDesc';
    }

    public function toggleCategory($categoryId): void
    {
        $this->category =
            $this->category !== $categoryId && $this->categoryExist($categoryId)
            ? $categoryId
            : null;
    }

    /// return type: bool
    public function categoryExist($categoryId): bool
    {
        return Category::where('id', $categoryId)->exists();
    }


    public function validSort($sort): bool
    {
        // check if  $sort is in   [ 'recentAsc', 'recentDesc']
        return in_array(
            $sort,
            [
                'recentAsc',
                'recentDesc',
            ]

        );
    }
}

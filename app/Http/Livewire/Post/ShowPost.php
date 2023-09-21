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
    // protected $querystring 是 Livewire 组件中用于定义 URL 查询参数的属性。
    //这个属性用于定义 Livewire 组件在处理请求时，应该如何处理 URL 查询参数
    protected $querystring = [
        //'category' 是查询参数的名称，它表示在 URL 中的查询参数名。
        //['except' => '']:如果 'category' 查询参数  没有在 URL 中提供，Livewire 将默认将其设置为一个空字符串。
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
                'posts' => $posts->paginate(10),
                'categories' => $categories,
                'selectedCategory' => $this->category,
                'selectedSortBy' => $this->sortBy,
            ]

        );
    }

    public function sortBy($sort): void
    {

        // 如果是合法的sort类型，则使用
        //否则使用默认值recentDesc
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

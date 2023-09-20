<?php

namespace App\Http\Livewire\Post;

use App\Models\Category;
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

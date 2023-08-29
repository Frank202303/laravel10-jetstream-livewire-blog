<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // slug:鼻涕虫 for SEO
        // 哪些字段 可以 修改：保护 数据库
    protected $fillable=[
        'name',
        'slug',
        'parent_id',
    ];

    /// HAVE            s
    public function posts()
    {
        // define relation
        // one Category has Many Posts!!
        return $this->hasMany(Post::class);
    }

    public function subCategories()
    {
        // 这段代码定义了一个在当前模型中的方法 subCategories，用于建立当前模型与 Category 模型之间的一对多关系。
        // 在获取当前模型实例时，还会预加载每个实例关联的 categories，以提高查询效率。

        // hasMany(Category::class,'parent_id')：这部分代码表示当前模型拥有多个 Category 模型的实例，即一对多关系。
        // Category::class 表示关联的模型是 Category 类。
        // 'parent_id' 是外键列的名称，它用于在当前模型中找到与之相关的子模型。
        // with('categories')：这部分代码指定了在获取当前模型实例时，一并预加载关联的 categories。
        // 这可以有效地避免 N+1 查询问题，即在获取多个模型实例时，不会为每个模型实例都执行额外的查询来获取关联数据。



        //                                 外键
        // return $this->hasMany(Category::class,'parent_id')->with('categories');
        return $this->hasMany(Category::class,'parent_id');
    }


    /// get method: in MODEL
    /// get method
    /// get method
    // so in blade: we can use {{ $post->title() }}
    // so in blade: we can use {{ $post->title() }}
    // so in blade: we can use {{ $post->title() }}
    public function name(): string
    {
        return $this->name;
    }
    public function slug(): string
    {
        return $this->slug;
    }
    public function parentId(): int
    {
        return $this->parent_id;
    }

}

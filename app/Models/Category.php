<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // slug:鼻涕虫 for SEO
        // 哪些字段 可以 修改：保护 数据库
    protected $fillable=['name','slug'];

    /// HAVE            s
    public function posts()
    {
        // define relation
        // one Category has Many Posts!!
        return $this->hasMany(Post::class);
    }
}

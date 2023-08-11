<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    // 哪些字段 可以 修改：保护 数据库
    protected $fillable=['id','title','body'];

    public function user()
    {
        // post belongs To User
        // define relation
        return $this->belongsTo(User::class)->withDefault('Admin User');
    }

    public function category()
    {
        // define relation
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        // define relation
        return $this->belongsToMany(Tag::class,'post_tag');
    }
}

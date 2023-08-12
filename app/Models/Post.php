<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    // 哪些字段 可以 修改：保护 数据库
    protected $fillable=[
        'cover_image',
        'title',
        'slug',
        'body',
        'meta_description',
        'published_at',
        'featured',
        'author_id',
        'category_id',
    ];






    public function user()
    {
        // post belongs To User
        // define relation
        //                                     外键
        return $this->belongsTo(User::class, 'author_id')->withDefault('Admin User');
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

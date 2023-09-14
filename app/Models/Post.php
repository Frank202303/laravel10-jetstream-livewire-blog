<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    // 哪些字段 可以 修改：保护 数据库
    protected $fillable = [
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
        return $this->belongsToMany(Tag::class, 'post_tag');
    }

    /// get method: in MODEL
    /// get method
    /// get method
    // so in blade: we can use {{ $post->title() }}
    // so in blade: we can use {{ $post->title() }}
    // so in blade: we can use {{ $post->title() }}

    public function title(): string
    {
        return $this->title;
    }

    public function coverImage(): string
    {
        return $this->cover_image;
    }
    public function body(): string
    {
        return $this->body;
    }
    // public function slug(): string
    // {
    //     return $this->slug;
    // }
    public function metaDescription(): string
    {
        return $this->meta_description;
    }
    public function publishedAt(): string
    {
        return $this->published_at;
    }
    public function featured(): bool
    {
        return $this->featured;
    }
    public function authorId(): int
    {
        return $this->author_id;
    }
    public function categoryId(): int
    {
        return $this->category_id;
    }

    public static function searchPost($search)
    {
        return empty($search) ?
            static::query()
            :
            static::query()->where('id', 'like', '%' . $search . '%')
            ->orWhere('title', 'like', '%' . $search . '%')
            ->orWhere('body', 'like', '%' . $search . '%');
    }
}

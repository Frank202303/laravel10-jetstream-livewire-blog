<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    // 哪些字段 可以 修改：保护 数据库
    protected $fillable = ['name', 'slug'];

    public function posts()
    {
        // define relation
        return $this->belongsToMany(Post::class);
    }


    // get method: in MODEL
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
}

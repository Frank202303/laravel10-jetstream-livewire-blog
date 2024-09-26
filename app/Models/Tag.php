<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    // Which fields can be modified: protect the database
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

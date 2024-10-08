<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Builder;

class Post extends Model
{
    use HasFactory;
    // Which fields can be modified: protect the database
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
        //                                     Foreign Keys
        return $this->belongsTo(User::class, 'author_id')->withDefault('Admin User');
    }
    // A post ($this) can only belong to one category
    public function category()
    {
        // define relation
        return $this->belongsTo(Category::class);
    }
    // Many-to-many relationship
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
        // return $this->meta_description;
        // Fix TypeError
        // The reason is that meta_description is set to be nullable in the database
        // PHP 8.1.17
        // 10.18.0
        // App\Models\Post::metaDescription(): Return value must be of type string, null returned
        // So. Use is_null to check, if it is null, use title to create a meta_description
        return is_null($this->meta_description)
            ? ('<div>' . $this->title . '</div>')
            : $this->meta_description;
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

    /// Local Scopes: Similar to the get method
    public function scopeCategory(Builder $query, string $category): Builder
    {
        return $query->where('category_id', $category);
    }
    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('featured', true);
    }

    public function scopePublished(Builder $query): Builder
    {
        $today = new \DateTime();
        return $query->whereNotNull('published_at')
            ->where('published_at', '<=', $today);
    }

    public function scopeRecentAsc(Builder $query): Builder
    {
        return $query->orderBy('title', 'asc');
    }

    public function scopeRecentDesc(Builder $query): Builder
    {
        return $query->orderBy('title', 'desc');
    }
    // Remove the meta description div
    public function  metaDescriptionFormat()
    {
        return  strip_tags($this->metaDescription());
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // slug: slug for SEO
    // Which fields can be modified: protect the database
    protected $fillable = [
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
        // This code defines a method subCategories in the current model, which is used to establish a one-to-many relationship between the current model and the Category model.
        // When getting the current model instance, the categories associated with each instance are also preloaded to improve query efficiency.

        // hasMany(Category::class,'parent_id'): This part of the code indicates that the current model has multiple instances of the Category model, that is, a one-to-many relationship.
        // Category::class indicates that the associated model is the Category class.
        // 'parent_id' is the name of the foreign key column, which is used to find the child model related to it in the current model.
        // with('categories'): This part of the code specifies that when getting the current model instance, the associated categories are also preloaded.
        // This can effectively avoid the N+1 query problem, that is, when getting multiple model instances, no additional query is performed for each model instance to obtain the associated data.



        //                                 Foreign Keys
        // return $this->hasMany(Category::class,'parent_id')->with('categories');
        return $this->hasMany(Category::class, 'parent_id');
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

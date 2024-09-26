<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.posts.index', []);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.posts.create', [
            'tags' => Tag::all(),
            'categories' => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    /// StorePostRequest: data validation
    // When debugging: Use Request!!!
    // for PHP 8, the line would be extension=gd
    public function store(StorePostRequest $request)
    {
        // For test
        // return $request;
        // dd($request);

        // ////
        // $this->validate($request, [
        //     'cover_image'        => ['required', 'mimes:png,jpg,gif,svg', 'max:2048'],
        //     'title'              => ['required', 'max:200', 'min:5'],
        //     // 'slug'              => ['required', 'max:200',],
        //     'body'              => ['required', 'min:5',],
        //     'meta_description'  => ['required', 'min:5', 'max:200',],
        //     'published_at'      => ['required', ''],
        //     // 'author_id'          => ['required',],
        //     'category_id'        => ['required', 'numeric'],
        //     'tags'               => ['required'],
        // ]);

        // ////


        $tags = explode(',', $request->tags);
        // return  $tags;
        $post = new Post();
        $post->title                  = $request->title;
        $post->slug                  =  Str::slug($request->title);

        $post->body                  = $request->body;
        $post->meta_description      = $request->meta_description;
        $post->published_at           = $request->published_at;


        $post->author_id              = Auth::user()->id;
        $post->category_id            = $request->category_id;


        // save file in: blog\storage\app\public\images
        // save file name in:  $post->cover_image
        if ($request->hasFile('cover_image')) {
            $image = $request->file('cover_image');
            $imageName = $image->getClientOriginalName();
            $imageFirstName = explode('.', $imageName)[0];
            $fileExtension = time() . '.'
                . $imageFirstName . '.'
                . $image->getClientOriginalExtension();
            $location = storage_path('app/public/images/' . $fileExtension);
            // Compress and save
            Image::make($image)->resize(1200, 630)->save($location);
            $post->cover_image            =  $fileExtension;
        }
        $post->save();
        // Call to undefined method App\Models\Post::sync()
        $post->tags()->sync($tags);
        return  redirect()->route('posts.index')->with('success', 'Post successfully created');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)

    {
        $categories = Category::all();
        $tags = Tag::all();
        ///  ???Why no reminder?
        $oldTags = $post->tags->pluck('id')->toArray();
        return view(
            'dashboard.posts.edit',
            compact('post', 'categories', 'tags', 'oldTags'),
        );
    }

    /**
     * Update the specified resource in storage.
     */
    /// UpdatePostRequest
    public function update(UpdatePostRequest $request, Post $post)

    {
        // return $request;


        $post->title                  = $request->title;
        $post->slug                  =  Str::slug($request->title);
        $post->body                  = $request->body;
        $post->meta_description      = $request->meta_description;
        $post->published_at           = $request->published_at;
        $post->author_id              = Auth::user()->id;
        $post->category_id            = $request->category_id;


        // save file in: blog\storage\app\public\images
        // save file name in:  $post->cover_image
        if ($request->hasFile('cover_image')) {
            $oldFileName = $post->cover_image;
            $image = $request->file('cover_image');
            $imageName = $image->getClientOriginalName();
            $imageFirstName = explode('.', $imageName)[0];
            $fileExtension = time() . '.'
                . $imageFirstName . '.'
                . $image->getClientOriginalExtension();
            $location = storage_path('app/public/images/' . $fileExtension);
            // Compress and save
            Image::make($image)->resize(1200, 630)->save($location);
            $post->cover_image            = $fileExtension;
            // delete previous image
            File::delete(storage_path('app/public/images/' . $oldFileName));
        }
        $post->save();
        //
        return  redirect()->route('posts.index')->with('success', 'Post successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}

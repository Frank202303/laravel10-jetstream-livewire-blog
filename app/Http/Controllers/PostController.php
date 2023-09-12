<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    /// StorePostRequest ：数据 校验
    // 调试时： 使用Request ！！！
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
            // 压缩 并 保存
            Image::make($image)->resize(1200, 630)->save($location);
            $post->cover_image            = $request->cover_image;
        }
        $post->save();
        // Call to undefined method App\Models\Post::sync()
        $post->tags()->sync($tags);
        return  redirect()->route('posts.index')->with('success', 'Post successfully created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('dashboard.posts.show', []);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}

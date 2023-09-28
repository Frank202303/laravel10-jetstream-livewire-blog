<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware();
    // }
    public function index()
    {
        return view('pages.blog.index');
    }
    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('pages.blog.show', compact('post'));
    }
}

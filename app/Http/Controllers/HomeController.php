<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Authenticate;
use App\Models\Post;
use DateTime;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // public function __construct()
    // {
    // // Only people who have passed auth authentication can access this controller,
    // // except: do not use auth check for index method
    // return $this->middleware('auth')->except(['index']);
    // // only(['index']): This part of the code specifies that the middleware is only applied to the index method of the controller.
    // // This means that authentication will only be triggered when the index method of the controller is accessed. Other methods will not be affected by this middleware.
    // // return $this->middleware('auth')->only(['index']);

    // // Or write like this, you can add multiple middleware
    // return $this->middleware([Authenticate::class,IsAdmin::class])->except(['index']);
    // }

    public function index()
    {
        $today = new \DateTime();
        $posts = Post::where('featured', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', $today)
            ->latest()
            ->take(3)
            ->get();;
        return view('home.index', compact('posts'));
    }
}

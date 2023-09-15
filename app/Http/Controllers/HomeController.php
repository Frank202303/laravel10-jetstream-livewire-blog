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
    //     // 只有通过auth认证的人才能 访问这个控制器，
    //     // except：不对index方法使用auth检查
    //     return $this->middleware('auth')->except(['index']);
    //     // only(['index'])：这部分代码指定只在控制器的 index 方法上应用中间件。
    //     // 这意味着只有当访问控制器的 index 方法时，才会触发身份验证。其他方法将不会受到该中间件的影响。
    //     // return $this->middleware('auth')->only(['index']);

    //     // 或者 这么写，可以加多个middle ware
    //     return $this->middleware([Authenticate::class,IsAdmin::class])->except(['index']);
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

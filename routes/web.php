<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Home Route,                                   通用 别名是'home'
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/blog', [BlogController::class, 'index'])->name('blog');



Route::group(['middleware' => ['auth'],  'prefix' => 'dashboard'], function () {

    // Dashboard
    Route::group(['prefix' => '',  'as' => 'dashboard.'], function () {
        // Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard.index');
        Route::get('/', [DashboardController::class, 'index'])->name('index');
    });

    // Categories
    // 实战  中使用这个，一个命令创建所有路由
    // 但是教学时，单个创建，易于 理解：
    // Route::resource('categories', CategoryController::class);
    Route::group(['prefix' => 'categories',  'as' => 'categories.'], function () {
        // Route::get('/categories',[CategoryController::class,'index'])->name('categories.index');
        Route::get('/', [CategoryController::class, 'index'])->name('index');


        // 通过name categories.create使用该路由时，调用CategoryController::class,里的 'create'方法，return一个view
        Route::get('create', [CategoryController::class, 'create'])->name('create');
        // 在编辑页面，点击form提交时，通过 name categories.store使用该路由，然后调用CategoryController::class,里的 'store'方法
        Route::post('/', [CategoryController::class, 'store'])->name('store');


        Route::get('{category:slug}/edit', [CategoryController::class, 'edit'])->name('edit');
        Route::put('{category:slug}', [CategoryController::class, 'update'])->name('update');


        Route::delete('{category:slug}/delete', [CategoryController::class, 'destroy'])->name('delete');
        //
        Route::get('subcategory', [CategoryController::class, 'subCategory'])->name('subCategory');
    });

    // Tags
    Route::group(['prefix' => 'tags',  'as' => 'tags.'], function () {

        Route::get('/', [TagController::class, 'index'])->name('index');

        Route::get('create', [TagController::class, 'create'])->name('create');
        Route::post('/', [TagController::class, 'store'])->name('store');

        Route::get('{tag:slug}/edit', [TagController::class, 'edit'])->name('edit');
        Route::put('{tag:slug}', [TagController::class, 'update'])->name('update');

        Route::delete('{tag:slug}/delete', [TagController::class, 'destroy'])->name('delete');
    });

    // Posts
    Route::group(['prefix' => 'posts',  'as' => 'posts.'], function () {

        Route::get('/', [PostController::class, 'index'])->name('index');

        Route::get('create', [PostController::class, 'create'])->name('create');
        Route::post('/', [PostController::class, 'store'])->name('store');

        Route::get('{post:slug}/edit', [PostController::class, 'edit'])->name('edit');
        Route::put('{post:slug}', [PostController::class, 'update'])->name('update');


        Route::delete('{post:slug}/delete', [PostController::class, 'destroy'])->name('delete');
    });
});


// Route::get('/{post:slug}', [BlogController::class, 'show'])->name('blog.show'); 这个路由是通用的，它可以匹配任何slug格式的URL，包括 dashboard 这样的slug。
// 路由的优先级和匹配顺序上。Laravel 路由是按照定义的顺序进行匹配的，一旦找到匹配的路由，就会停止继续查找。
// 所以 将通用路由移到最后
// post:slug == post->title
Route::get('/{post:slug}', [BlogController::class, 'show'])->name('blog.show'); //??

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard.index');
//     })->name('dashboard');
// });

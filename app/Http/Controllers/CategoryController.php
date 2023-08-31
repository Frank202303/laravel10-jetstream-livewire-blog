<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 从数据库中检索所有顶级分类，同时预加载每个顶级分类关联的子分类数据，以便在一次查询中获取完整的层级结构数据。
        // Category::with('subCategories')  同时检索主分类和与之关联的子分类数据
        // ->whereNull('parent_id'): 这是一个查询条件，它限制了只选择 parent_id（父级分类 ID）为空的记录，也就是顶级分类。
        // get(): 这是一个最终的方法调用，它实际执行数据库查询并检索匹配条件的数据行
        $categories = Category::with('subCategories')->whereNull('parent_id')->get();
        // pass para
        return view('dashboard.categories.index', compact('categories'));
        // 也可以
        // return view('dashboard.categories.index',['categories'=> Category::with('subCategories')->whereNull('parent_id')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(
            'dashboard.categories.create',
            ['categories' => Category::with('subCategories')->whereNull('parent_id')->get()],
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     /// one way
    //     $this->validate($request,[
    //         'name'=>['required','max:200'],
    //         'parent_id'=>['sometimes','nullable','numeric'],
    //     ]);
    //     /// the second way
    //     // php artisan make:request StoreCategoryRequest

    //     return $request;
    // }
    public function store(StoreCategoryRequest $request)
    {
        // we can
        // $this->dispatch(CreateCategoriesTable::fromRequest($request));
        /// we also can
        $category = new Category();
        $category->name = $request->name;
        $category->parent_id = $request->parent_id;
        ///
        $category->slug = Str::slug($request->name);
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category successfully created');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        // $categories = Category::with('subCategories')->whereNull('parent_id')->get();
        return view('dashboard.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     * 用于处理 HTTP 请求的方法，具体来说是处理更新操作。该方法接受两个参数：
     * $request: 这是一个包含了 HTTP 请求信息的对象，包括表单数据、请求头等。
     * $category: 这是一个从 URL 中传递的路由参数（通常是通过路由模型绑定获得的）。它表示要更新的特定分类的实例。
     * 在方法内部，您可以直接使用此对象来进行更新操作，而无需手动查询数据库。
     *
     * $category->slug = Str::slug($request->name);: 这一行使用 Laravel 的 Str::slug() 函数
     * 生成一个基于新名称的 URL 友好的 slug，通常用于构建 SEO 友好的 URL。
     *
     * 附带一个成功的闪存消息,保存在session，以便在页面上显示成功更新的消息
     */
    public function update(Request $request, Category $category)
    {
        // 用于调试!!!!
        // 输出  {"_token":"D7jNNJApud0WDvgjjeCyt5bw4U6mivUJ2ho7BamJ","_method":"PUT","name":"HolidayTRY"}
        // return $request;

        $this->validate($request, [
            'name' => ['required', 'max:200', 'unique:categories'],
            'parent_id' => ['sometimes', 'nullable']
        ]);
        $category->name = $request->name;
        $category->slug =  Str::slug($request->name);
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category successfully updated');
        // 调试 专用 return redirect()->route('categories.index')->with('error', 'Category successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        // with('success', 'Category deleted');放在session里
        return redirect()->route('categories.index')->with('success', 'Category deleted');
    }
}

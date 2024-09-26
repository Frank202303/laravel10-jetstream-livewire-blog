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
        // Retrieve all top-level categories from the database and preload the sub-category data associated with each top-level category so that the complete hierarchical structure data can be obtained in one query.
        // Category::with('subCategories') retrieves both the main category and the sub-category data associated with it
        // ->whereNull('parent_id'): This is a query condition that restricts the selection to only records where the parent_id (parent category ID) is null, that is, the top-level category.
        // get(): This is the final method call that actually executes the database query and retrieves the data rows that match the condition
        $categories = Category::with('subCategories')->whereNull('parent_id')->get();
        // pass para
        return view('dashboard.categories.index', compact('categories'));
        // you can also
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
        // parent
        $categories = Category::with('subCategories')->whereNull('parent_id')->get();
        // dd($categories);
        return view('dashboard.categories.edit', compact('category', 'categories'));
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
        // For debugging!!!!
        // Output {"_token":"D7jNNJApud0WDvgjjeCyt5bw4U6mivUJ2ho7BamJ","_method":"PUT","name":"HolidayTRY"}
        // return $request;

        $this->validate($request, [
            // Youtube 老师 把 'unique:categories'删除了
            'name' => ['required', 'max:200', 'unique:categories'],
            'parent_id' => ['sometimes', 'nullable']
        ]);
        $category->name = $request->name;
        $category->slug =  Str::slug($request->name);
        if (!is_null($request->parent_id)) {
            $category->parent_id = $request->parent_id;
        }

        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category successfully updated');
        // Debug Dedicated return redirect()->route('categories.index')->with('error', 'Category successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        // with('success', 'Category deleted'); put it in session
        return redirect()->route('categories.index')->with('success', 'Category deleted');
    }

    public function subCategory()
    {
        // only return child Category
        return view(
            'dashboard.categories.subcategory',
            // In the Category table, query the parent_id field, and the query condition is that parent_id is not empty
            // Category::with('subCategories') is a way of using Eloquent ORM in Laravel to eagerly load related models.
            // In the Category model, there is
            // public function subCategories()
            // {
            // return $this->hasMany(Category::class, 'parent_id');
            // }
            // The subCategories method uses the hasMany association method to define a one-to-many relationship to get the subcategories of the category. 'subCategories' is not an actual database field, but a method name used to define an association.

            // In your controller code, Category::with('subCategories') uses this association method, which means that when querying categories, the related subcategory data is also eagerly loaded to avoid the N+1 query problem.

            ['categories' => Category::with('subCategories')->whereNotNull('parent_id')->get()],
            // ['categories' => Category::whereNotNull('parent_id')->get()], // This code also works
        );
    }
}

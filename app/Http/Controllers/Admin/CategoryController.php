<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\EditCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $title = "لیست دسته بندی ها";
        $categories = Category::getAllCategories();
        return view('admin.category.categories',compact('categories','title'));
    }


    public function create()
    {
        $title = "ایجاد دسته بندی";
        $categories = Category::getAllCategories();
        return view('admin.category.create',compact('title','categories'));
    }


    public function store(CreateCategoryRequest $request)
    {
        Category::createCategory($request);
        return redirect()->route('categories.index')->with('success', __('messages.category.created'));
    }


    public function show(Category $category)
    {
        $title = "نمایش دسته بندی";
        return view('admin.category.show',compact('category','title'));
    }


    public function edit(Category $category)
    {
        $title = "ویرایش دسته بندی";
        $categories = Category::getAllCategories();
        return view('admin.category.edit',compact('title','category','categories'));
    }


    public function update(EditCategoryRequest $request, Category $category)
    {
        Category::updateCategory($request, $category);
        return redirect()->route('categories.index')->with('success', __('messages.category.updated'));
    }


    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', __('messages.category.deleted'));
    }
}

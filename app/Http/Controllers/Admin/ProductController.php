<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\EditProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\ColorProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $title = "لیست محصولات";
        $products = Product::getAllProducts();
        return view('admin.product.products',compact('products','title'));
    }


    public function create()
    {
        $title = "ایجاد محصول";
        $categories = Category::query()->pluck('title','id');
        $brands = Brand::query()->pluck('title', 'id');
        $colors = Color::getAllColors();
        return view('admin.product.create',compact('title','categories','brands','colors'));
    }


    public function store(CreateProductRequest $request)
    {
        Product::createProduct($request);
        return redirect()->route('products.index')->with('success', __('messages.product.created'));
    }


    public function show(Product $product)
    {
        $title = "نمایش محصول";
        return view('admin.product.show',compact('title','product'));
    }


    public function edit(Product $product)
    {
        $title = "ویرایش محصول";
        $categories = Category::query()->pluck('title','id');
        $brands = Brand::query()->pluck('title', 'id');
        $colors = Color::getAllColors();
        return view('admin.product.edit',compact('title','product','categories','brands','colors'));
    }


    public function update(EditProductRequest $request, Product $product)
    {
        Product::updateProduct($request,$product);
        return redirect()->route('products.index')->with('success', __('messages.product.updated'));
    }


    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', __('messages.product.deleted'));
    }
}

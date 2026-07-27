<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateProductGalleryRequest;
use App\Models\Gallery;
use App\Models\Product;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(string $id)
    {
        $title = "گالری محصول";
        $product = Product::getProduct($id);
        $images = Gallery::getProductGallery($id);
        return view('admin.product.ProductGallery',compact('title','images','product'));
    }


    public function create(string $id)
    {
        $title = "افزودن عکس";
        $product = Product::getProduct($id);
        return view('admin.product.createProductGallery',compact('title','product'));
    }


    public function store(CreateProductGalleryRequest $request)
    {
        Gallery::createGallery($request);
        return redirect()->back()->with('success', __('messages.gallery.created'));
    }


    public function deleteGallery(string $id)
    {
        $image = Gallery::query()->findOrFail($id);
        $image->delete();
        return redirect()->back()->with('success', __('messages.gallery.deleted'));
    }
}


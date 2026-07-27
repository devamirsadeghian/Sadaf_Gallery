<?php

namespace App\Http\Controllers\Home;

use App\Enums\CommentStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Contact\CreateContactRequest;
use App\Models\Comment;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Slader;

class HomeController extends Controller
{
    public function home()
    {
        $Sliders = Slader::getAllSliders();
        $categories = Category::get3FirstCategory()->keyBy('title');

        $newestRequest = new Request(['sort' => 'newest']);
        $mostSoldRequest = new Request(['sort' => 'most_sold']);
        $cheapestRequest = new Request(['sort' => 'cheapest']);

        $NewestProducts = Product::filterProducts($newestRequest, 6);
        $MostSellerProducts = Product::filterProducts($mostSoldRequest, 6);
        $CheapestProducts = Product::filterProducts($cheapestRequest, 6);

        return view('home.home',compact('Sliders','NewestProducts','MostSellerProducts','CheapestProducts','categories'));
    }

// ProductRepositoryWeb
    public function shop(Request $request)
    {
        $products = Product::filterProducts($request);
        $categories = Category::get3FirstCategory();

        return view('home.shop', compact('products','categories'));
    }


    public function product_details($id)
    {
        $product = Product::getProduct($id);
        $product->increment('review');
        $comments = Comment::with('user','replies.user')
            ->where('status', CommentStatus::accept)
            ->where('product_id', $product->id)
            ->whereNull('parent_id')
            ->latest()
            ->get();

        return view('Home.product_details',compact('product','comments'));
    }


    public function filter(Request $request)
    {
        $products = Product::filterProducts($request);

        return view('home.partial.products', compact('products'));
    }
}



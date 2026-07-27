<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Repositories\ProductRepository;
use App\Http\Resources\ProductResource;
use App\Http\Resources\PropertyResource;
use App\Http\Services\Keys;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;

class ProductsApiController extends Controller
{
    use ApiResponse;

    public static function most_sold_products()
    {
        return self::success( __('api.products.most_sold_products'),[
            Keys::categories => Category::getAllCategoriesResource(),
            Keys::most_seller_products => ProductResource::collection(ProductRepository::getMostSellerProducts()),
        ], 200);
    }


    public static function most_viewed_products()
    {
        return self::success(__('api.products.most_viewed_products'),[
            Keys::categories => Category::getAllCategoriesResource(),
            Keys::most_viewed_products => ProductResource::collection(ProductRepository::getMostViewedProducts()),
        ], 200);
    }


    public static function newest_products()
    {
        return self::success(__('api.products.newest_products'),[
            Keys::categories => Category::getAllCategoriesResource(),
            Keys::newest_products => ProductResource::collection(ProductRepository::getNewestProducts()),
        ], 200);
    }


    public static function cheapest_products()
    {
        return self::success(__('api.products.cheapest_products'),[
            Keys::categories => Category::getAllCategoriesResource(),
            Keys::cheapest_products => ProductResource::collection(ProductRepository::getCheapestProducts()),
        ], 200);
    }


    public static function most_expensive_products()
    {
        return self::success(__('api.products.most_expensive_products'),[
            Keys::brands => Brand::getAllBrandsResource(),
            Keys::most_expensive_products => ProductResource::collection(ProductRepository::getMostExpensiveProducts()),
        ],
            'application products page', 200);
    }


    public static function biggest_discount()
    {
        return self::success(__('api.products.biggest_discount'),[
            Keys::most_biggest_discount => ProductResource::collection(ProductRepository::getBiggestDiscount()),
        ], 200);
    }



//  products_by***
    public static function products_by_category($id)
    {
        return self::success(__('api.auth.products_by_category'),[
            Keys::brands => Brand::getAllBrandsResource(),
            Keys::products_by_category => ProductRepository::getProductsByCategory($id)->response()->getData(true),
        ], 200);
    }


    public static function products_by_brand($id)
    {
        return self::success(__('api.products.products_by_brand'),[
            Keys::brands => Brand::getAllBrandsResource(),
            Keys::products_by_brand => ProductRepository::getProductsByBrand($id)->response()->getData(true),
        ], 200);
    }


    public static function products_details($id)
    {
        $product = Product::getProduct($id);
        $product->increment('review');     // increase view products

        return self::success(__('api.products.products_details'),[
            new ProductResource($product)
        ], 200);
    }


    public static function save_product_comment(Request $request)
    {
        $user = auth()->user();
        $comment = Comment::createComment($request);
        $product = Product::getProduct($request->product_id);

        return self::success(__('api.products.save_product_comment'),[
            new ProductResource($product)
        ], 200);
    }


    public static function search_product(Request $request)
    {
        return self::success(__('api.products.search_product'),[
            Keys::brands => Brand::getAllBrandsResource(),
            Keys::search_products => ProductRepository::SearchedProducts($request->search)->response()->getData(true),
        ], 200);
    }
}


<?php

namespace App\Http\Repositories;

use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductRepository
{
    public static function get6AmazingProducts()
    {
        $products = Product::query()->where('is_special',true)
            ->orderBy('discount','DESC')
            ->take(6)
            ->get();

        return ProductResource::collection($products);
    }


    public static function get6MostSellerProducts()
    {
        $products = Product::query()
            ->orderBy('sold','DESC')
            ->take(6)
            ->get();

        return ProductResource::collection($products);
    }


    public static function get6NewestProducts()
    {
        $products = Product::query()
            ->orderBy('created_at','DESC')
            ->take(6)
            ->get();

        return ProductResource::collection($products);
    }


    public static function getMostSellerProducts()
    {
        $products = Product::query()
            ->orderBy('sold','DESC')
            ->paginate(13);

        return ProductResource::collection($products);
    }


    public static function getNewestProducts()
    {
        $products = Product::query()
            ->orderBy('created_at','DESC')
            ->paginate(12);

        return ProductResource::collection($products);
    }


    public static function getMostViewedProducts()
    {
        $products = Product::query()
            ->orderBy('review','DESC')
            ->paginate(12);

        return ProductResource::collection($products);
    }


    public static function getCheapestProducts()
    {
        $finalPrice = '(price - discount)';

        $products = Product::query()
            ->orderByRaw("$finalPrice ASC")
            ->paginate(12);

        return ProductResource::collection($products);
    }


    public static function getMostSoldProducts()
    {
        $products = Product::query()
            ->orderBy('sold','DESC')
            ->paginate(12);

        return ProductResource::collection($products);
    }


    public static function getMostExpensiveProducts()
    {
        $finalPrice = '(price - discount)';

        $products = Product::query()
            ->orderByRaw("$finalPrice DESC")
            ->paginate(12);

        return ProductResource::collection($products);
    }


    public static function getBiggestDiscount()
    {
        $products = Product::query()
            ->where('price', '>', 0)
            ->orderByRaw('(discount / price) DESC')
            ->paginate(12);

        return ProductResource::collection($products);
    }



//  getProductsBy***
    public static function getProductsByCategory($id)
    {
        $products = Product::query()
            ->where('category_id',$id)->paginate(12);
            return ProductResource::collection($products);
    }


    public static function getProductsByBrand($id)
    {
        $products = Product::query()
            ->where('brand_id',$id)->paginate(12);
        return ProductResource::collection($products);
    }


    public static function SearchedProducts($search)
    {
        $products = Product::query()
            ->where('title_fa','like','%'.$search.'%')
            ->orWhere('title_en','like','%'.$search.'%')
            ->orWhere('description','like','%'.$search.'%')
            ->paginate(12);
        return ProductResource::collection($products);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class BasketDetails extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
        'basket_id',
        'product_id',
        'color_id',
        'count',
        'price',
        'discount',
    ];

    public function basket(): BelongsTo
    {
        return $this->belongsTo(Basket::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class,'color_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }




    public static function getBasketDetails($basketId)
    {
        return self::where('basket_id', $basketId)->with(['product', 'color'])->get();
    }


    public static function getTotalPrice($basketId)
    {
        return self::where('basket_id', $basketId)
            ->get()
            ->sum(function ($item) {
                return ($item->price - $item->discount) * $item->count;
            });
    }


    public static function existProductWithColor($basket, $product, $request)
    {
        $query = self::where('basket_id', $basket->id)
            ->where('product_id', $product->id);

        if ($request->filled('color_id')) {
            $query->where('color_id', $request->color_id);
        } else {
            $query->whereNull('color_id');
        }

        return $query->first();
    }



    public static function getPrice($product)
    {
        return $product->price;
    }


    public static function getDiscount($product)
    {
        return $product->discount ?? 0;
    }


    public static function getItem($id)
    {
        return self::query()->findOrFail($id);
    }


    public static function createBasketDetails($basket, $product, $request)
    {
        return self::create([
            'basket_id'  => $basket->id,
            'product_id' => $product->id,
            'color_id'   => $request->color_id,
            'count'      => $request->count,
            'price'      => $product->price,
            'discount'   => $product->discount,
        ]);
    }
}


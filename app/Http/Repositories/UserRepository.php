<?php

namespace App\Http\Repositories;

use App\Enums\BasketDetailsStatus;
use App\Enums\BasketStatus;
use App\Enums\OrderDetailsStatus;
use App\Enums\OrderStatus;
use App\Http\Resources\BasketResource;
use App\Http\Resources\OrderResource;
use App\Models\Basket;
use App\Models\Order;

class UserRepository
{
    // received
    public static function receivedUserOrder($user)
    {
        $baskets = Basket::query()->whereHas('items',function ($q){
            return $q->where('status',BasketDetailsStatus::received->value);
        })->where('user_id',$user->id)->where('status',BasketStatus::success->value)->get();

        return BasketResource::collection($baskets);
    }

    public static function receivedUserOrderCount($user)
    {
        return $baskets = Basket::query()->whereHas('items',function ($q){
            return $q->where('status',BasketDetailsStatus::received->value);
        })->where('user_id',$user->id)->where('status',BasketStatus::success->value)->count();
    }



    // processing
    public static function processingUserOrder($user)
    {
        $baskets = Basket::query()->whereHas('items',function ($q){
            return $q->where('status',BasketDetailsStatus::processing->value);
        })->where('user_id',$user->id)->where('status',BasketStatus::draft->value)->get();

        return BasketResource::collection($baskets);
    }

    public static function processingUserOrderCount($user)
    {
        return $baskets = Basket::query()->whereHas('items',function ($q){
            return $q->where('status',BasketDetailsStatus::processing->value);
        })->where('user_id',$user->id)->where('status',BasketStatus::draft->value)->count();
    }



    // rejected
    public static function rejectedUserOrder($user)
    {
        $baskets = Basket::query()->whereHas('items',function ($q){
            return $q->where('status',BasketDetailsStatus::rejected->value);
        })->where('user_id',$user->id)->where('status',BasketStatus::failed->value)->get();

        return BasketResource::collection($baskets);
    }

    public static function rejectedUserOrderCount($user)
    {
        return $baskets = Basket::query()->whereHas('items',function ($q){
            return $q->where('status',BasketDetailsStatus::rejected->value);
        })->where('user_id',$user->id)->where('status',BasketStatus::failed->value)->count();
    }
}



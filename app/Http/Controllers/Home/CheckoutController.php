<?php

namespace App\Http\Controllers\Home;

use App\Enums\BasketStatus;
use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Basket;
use App\Models\BasketDetails;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkout()
    {
        // سبد فعال کاربر
        $basket = Basket::getDraftBasket(auth()->id());
        $total = BasketDetails::getTotalPrice($basket->id);

        if (!$basket) {
            return redirect()
                ->route('shop')
                ->with('error', __('messages.basket.empty'));
        }

        $items = BasketDetails::getBasketDetails($basket->id);

        if ($items->isEmpty()) {
            return redirect()->route('shop')->with('error', __('messages.basket.empty'));
        }

        $address = Address::where('user_id', auth()->id())->first();

        if (!$address) {
            return redirect()->route('address.index')->with('error', __('messages.address.required'));
        }

        return view('home.checkout', compact('basket','items', 'address', 'total'));
    }
}



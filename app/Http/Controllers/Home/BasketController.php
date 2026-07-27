<?php

namespace App\Http\Controllers\Home;

use App\Enums\BasketStatus;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Basket;
use App\Models\BasketDetails;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    public function index()
    {
        $basket = Basket::getDraftBasket(auth()->id());

        if (!$basket) {
            return view('home.basket', [
                'baskets' => collect(),
                'total' => 0,
            ]);
        }

        $basketsDetails = BasketDetails::getBasketDetails($basket->id);
        $total = BasketDetails::getTotalPrice($basket->id);

        return view('home.basket', compact('basketsDetails', 'total'));
    }

    public function store(Request $request,string $id)
    {
        $request->validate([
            'count' => 'required|integer|min:1',
            'color_id' => 'nullable|exists:colors,id',
        ]);

        // سبد خرید فعال کاربر
        $userId = auth()->user()->id;
        $product = Product::getProduct($id);
        $basket = Basket::createBasket($userId);

        // آیا همین محصول با همین رنگ داخل سبد هست؟
        $item = BasketDetails::existProductWithColor($basket, $product, $request);

        if ($item) {
            return redirect()->route('shop')->with('info', __('messages.basket.exist'));
        } else {
            BasketDetails::createBasketDetails($basket, $product, $request);
        }

        return redirect()->route('shop')->with('success', __('messages.basket.added'));
    }


    public function destroy(string $id)
    {
        $basket = Basket::getDraftBasket(auth()->id());

        $item = BasketDetails::where('id', $id)
            ->where('basket_id', $basket->id)
            ->firstOrFail();

        $item->delete();

        return back()->with('success', __('messages.basket.deleted'));
    }


    public function baskets()
    {
        $title = "لیست فروش";
        $baskets = Basket::with('user')
            ->latest()
            ->paginate(10);

        return view('admin.basket.baskets',compact('baskets','title'));
    }

    public function baskets_details($id)
    {
        $title = "لیست محصولات";
        $baskets_details = BasketDetails::with(['product', 'color', 'basket.user',])->where('basket_id', $id)->paginate(10);
        return view('admin.basket.basket_details',compact('title','baskets_details'));
    }
}


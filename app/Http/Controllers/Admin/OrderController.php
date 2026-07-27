<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Basket;
use App\Models\BasketDetails;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orders()
    {
        $title = "لیست فروش";
        $orders = Basket::query()->paginate(10);
        return view('admin.order.orders',compact('orders','title'));
    }

    public function order_details($id)
    {
        $title = "لیست محصولات";
        $order_details= BasketDetails::query()->where('basket_id',$id)->paginate(10);

        return view('admin.order.order_details',compact('title','order_details'));
    }
}

<?php

namespace App\Http\Controllers\Home;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;

class PaymentController extends Controller
{
    public function payment(Request $request)
    {
        $user = auth()->user();
        $total_price = 0;

        foreach ($request->items as $item){
            $product = Product::query()->find($item['product_id']);
            if ($product->discount == 0 ){
                $total_price = $total_price * $item['count'];
            }else{
                $total_price = ( $product->price (( $product->price * $product->discount)/100)) * $item['count'];
            }
        }

        $order = Order::query()->create([
            'total_price' => $total_price,
            'status' => OrderStatus::draft->value,
            'address_id' => $request->address_id,
            'user_id' => $user->id,
            'code' => rand(1000,9999)
        ]);



        foreach ($request->items as $item){

            $product = Product::query()->find($item['product_id']);
            if ($product->discount == 0 ){
                $total_price = $total_price * $item['count'];
            }else{
                $total_price = ( $product->price (( $product->price * $product->discount)/100)) * $item['count'];
            }
        }

        $orderDetails = OrderDetail::query()->create([
            'order_id' => $order->id,
            'product_id' => $item['product_id'],
            'count' => $item['count'],
            'price' => $request->price,
            'discount' => $request->discount,
            'discount_price' => $total_price
        ]);

        $result = Payment::purchase(
            (new Invoice)->amount($total_price),
            function($driver, $transactionId) use ($order) {
                $order->update([
                    'transaction_id' => $transactionId
                ]);
            }
        )->pay()->toJson();

        return json_decode($result);
    }
}

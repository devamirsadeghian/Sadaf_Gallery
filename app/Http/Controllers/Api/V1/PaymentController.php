<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\OrderDetailsStatus;
use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Property;
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
            'address_id' => $request->address_id,
            'user_id' => $user->id,

            'status' => OrderStatus::draft->value,
            'code' => rand(1000,9999)
        ]);



        $orderDetails = OrderDetail::query()->create([
            'order_id' => $order->id,
            'product_id' => $item['product_id'],
            'count' => $item['count'],
            'price' => $request->price,
            'discount' => $request->discount,
            'discount_price' => $total_price
        ]);

         $result = \Faker\Provider\Payment::purchase(
            (new Invoice)->amount($total_price),
            function($driver, $transactionId) use ($order) {
                $order->update([
                    'transaction_id' => $transactionId
                ]);
            }
        )->pay()->toJson();

         return json_decode($result);
    }

    public function call_back(Request $request)
    {
        // خروجی جیسون یا درخواست دارای دو مقدار authority , status
        $authority = $_GET['Authority'];
        $order = Order::query()->where('transaction_id' , $authority)->first();
        $order_details = OrderDetail::query()->where('order_id',$order->id)->get();
        $code = $order->code;

        if ($_GET['status'] == 'OK'){
            $order->update([
                'status' => OrderStatus::success->value,
            ]);

            foreach ($order_details as $order_detail){
                $product = Product::query()->find($order_detail->product_id);
                $product->increment('sold');
                $product->decrement('count',$order_detail->count);

                $product->update([
                    'status' => OrderDetailsStatus::received->value,
                ]);
            }

            return view('admin.pay.accept',compact('code'));
        }else{
            $order->update([
                'status' => OrderStatus::failed->value,
            ]);

            foreach ($order_details as $order_detail){
                $order_detail->update([
                    'status' => OrderDetailsStatus::rejected->value,        // مقدار success  یکی از حالت های ستون status در جدول products است
                ]);
            }

            return view('admin.pay.reject');
        }
    }
}


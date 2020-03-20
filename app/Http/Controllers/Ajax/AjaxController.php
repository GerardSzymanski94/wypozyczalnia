<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AjaxController extends Controller
{
    public function addProduct(Request $request)
    {

        if (isset(auth()->user()->id)) {
            $userId = auth()->user()->id;
            $now = Carbon::now();
            $from = Carbon::now();
            $to = $now->addDays($request->days);
            $order = Order::firstOrCreate([
                'user_id' => $userId,
                'status' => 1,
            ], [
                'date_from' => $from,
                'date_to' => $to
            ]);

        } else {

            $sessionKey = Session::token();
            $now = Carbon::now();
            $from = Carbon::now();
            $to = $now->addDays($request->days);
            $order = Order::firstOrCreate([
                'session_key' => $sessionKey,
                'status' => 1,
            ], [
                'date_from' => $from,
                'date_to' => $to
            ]);

        }

        if ($request->has('product')) {
            $product = Product::find($request->product);
            $orderProduct = OrderProduct::create([
                'order_id' => $order->id,
                'days' => $request->days,
                'product_id' => $request->product,
                'amount' => $request->amount,
                'price' => $product->price($request->days, $request->amount),
                'status' => 1
            ]);
        }
        if ($request->has('additional')) {
            $product = Product::find($request->additional);
            $orderProduct = OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $request->additional,
                'amount_additional' => $request->amount_additional,
                'days' => $request->days,
                'price' => $product->priceAdditional($request->amount_additional),
                'status' => 1
            ]);
        }
        return response()->json(['view' => true]);
    }

    public function getPrice(Request $request)
    {
        $product = Product::find($request->product);

        $days = $request->days;
        $amount = $request->amount;

        $price = 0;
        $price = $price + $product->price($days, $amount);

        if (isset($request->additional)) {
            $amountAdditional = $request->amount_additional;
            $additional = Product::find($request->additional);
            $price = $price + $additional->priceAdditional($amountAdditional);
        }

        return response()->json(['price' => $price]);
    }
}

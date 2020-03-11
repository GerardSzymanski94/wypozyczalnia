<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function addProduct(Request $request)
    {
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
                'amount' => $request->amount,
                'days' => $request->days,
                'price' => $product->price($request->days, $request->amount),
                'status' => 1
            ]);
        }

        return response()->json(['view' => true]);
    }
}

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
        $orderProduct = OrderProduct::updateOrCreate([
            'order_id' => $order->id,
            'product_id' => $request->product,
            'days' => $request->days,
        ], [

        ]);
        $orderProduct = OrderProduct::updateOrCreate([
            'order_id' => $order->id,
            'product_id' => $request->additional,
            'days' => $request->days,
        ], [

        ]);

        /*        $product = Product::find($request->product);
                $days = $request->days;
                $additional = Product::find($request->additional);
                $id = $orderProduct->id;*/

        //$view = view('ajax.order_item', compact('product', 'days', 'additional', 'id'))->render();

        return response()->json(['view' => true]);
    }
}

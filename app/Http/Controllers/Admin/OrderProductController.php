<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;

class OrderProductController extends BaseController
{
    public function edit(OrderProduct $orderProduct)
    {
        return view('admin.orderproduct.edit', compact('orderProduct'));
    }

    public function update(Request $request, OrderProduct $orderProduct)
    {

    }

    public function extension(OrderProduct $orderProduct)
    {
        return view('admin.orderproduct.extension', compact('orderProduct'));
    }

    public function extension_save(OrderProduct $orderProduct, Request $request)
    {
        if (!$request->has('days'))
            return redirect()->back();
        $orderProduct->status = 5;
        $orderProduct->save();

        $newOrderProduct = $orderProduct->replicate();
        $newOrderProduct->status = 2;
        $newOrderProduct->days = $request->days;
        if (!is_null($orderProduct->days_to_return)) {
            $newOrderProduct->days_to_return = $request->days + $orderProduct->days_to_return;
        } else {
            $newOrderProduct->days_to_return = $request->days + $orderProduct->days;
        }
        $newOrderProduct->deposit = 0;
        $newOrderProduct->price = $newOrderProduct->product->price($newOrderProduct->days, $newOrderProduct->amount);
        $newOrderProduct->save();

        $order = $newOrderProduct->order;
        $price = $order->price();
        $order->total_price = $price;
        $order->save();

        return redirect()->route('admin.order.details', ['order' => $orderProduct->order->id]);
    }

    public function series_save(Request $request)
    {
        foreach ($request->series as $key => $series) {
            OrderProduct::whereId($key)->update(['series' => $series]);
        }

        return back()->with(['series_save' => true]);
    }

}

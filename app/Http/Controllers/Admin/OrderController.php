<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;

class OrderController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where('status', '>', 1)->get();
        return view('admin.order.list', compact('orders'));
    }

    public function details(Order $order)
    {
        return view('admin.order.details', compact('order'));
    }

    public function changeStatusToReturn(OrderProduct $orderProduct)
    {
        $orderProduct->changeStatus(3);
        $orderProduct->product->increaseAmount($orderProduct->amount);

        $this->changeOrderStatus($orderProduct->order);

        return redirect()->route('admin.order.details', ['order' => $orderProduct->order_id]);
    }

    public function changeStatusToUnavailable(OrderProduct $orderProduct)
    {
        $orderProduct->changeStatus(2);
        $orderProduct->product->reduceAmount($orderProduct->amount);

        $this->changeOrderStatus($orderProduct->order);

        return redirect()->route('admin.order.details', ['order' => $orderProduct->order_id]);
    }

    public function changeOrderStatus($order)
    {
        $unavailable = 0;
        $return = 0;

        foreach ($order->orderProducts as $orderProduct) {
            if ($orderProduct->status == 3) {
                $return++;
            } elseif ($orderProduct->status == 2) {
                $unavailable++;
            }
        }

        if ($unavailable == 0 && $return == 0) {

        } elseif ($unavailable > 0 && $return > 0) {
            $order->changeStatus(3);
        } elseif ($unavailable > 0 && $return == 0) {
            $order->changeStatus(2);
        } else {
            $order->changeStatus(4);
        }
    }

}

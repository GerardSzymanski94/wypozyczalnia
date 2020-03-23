<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Admin\BaseController;
use App\Models\Order;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    public function orders()
    {
        $orders = auth()->user()->orders;

        return view('user.list', compact('orders'));
    }

    public function details(Order $order)
    {
        if ($order->user_id != auth()->user()->id)
            return redirect()->route('index');

        return view('user.details', compact('order'));
    }
}

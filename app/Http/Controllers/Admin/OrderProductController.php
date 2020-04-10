<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
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
}

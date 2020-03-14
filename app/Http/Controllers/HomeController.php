<?php

namespace App\Http\Controllers;

use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::whereStatus(1)->get();
        $additionals = Product::whereStatus(2)->get();

        return view('home', compact('products', 'additionals', 'orderItems'));
    }

    public function cart()
    {
        $order = auth()->user()->actualOrder;
        return view('cart', compact('order'));
    }

    public function cartDelete(OrderProduct $product)
    {
        $product->delete();
        return redirect()->route('cart');
    }

    public function userData()
    {
        $user = auth()->user();
        $order = $user->actualOrder;
        return view('data', compact('order', 'user'));
    }

    public function saveOrder(Request $request)
    {
        $user = auth()->user();
        $user->street = $request->street;
        $user->city = $request->city;
        $user->zip_code = $request->zip_code;
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->save();

        $order = $user->actualOrder;
        $order->status = 2;
        $order->save();

        foreach ($order->orderProducts as $orderProduct) {
            $orderProduct->changeStatus(2);
            $orderProduct->product->reduceAmount($orderProduct->amount);
        }

        return redirect()->route('index');
    }
}

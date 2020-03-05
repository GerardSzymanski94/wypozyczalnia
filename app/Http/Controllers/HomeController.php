<?php

namespace App\Http\Controllers;

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
        $order = auth()->user()->actualOrder->orderProducts;
        // dd($orderItems);
        return view('home', compact('products', 'additionals', 'orderItems'));
    }
}

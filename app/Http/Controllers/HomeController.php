<?php

namespace App\Http\Controllers;

use App\Events\CompleteOrderEvent;
use App\Models\Configuration;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Repository\BaselinkerApiRepository;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
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

        return view('home', compact('products', 'additionals'));
    }

    public function cart()
    {
        if (isset(auth()->user()->id)) {
            $order = auth()->user()->actualOrder;
        } else {
            $order = Order::firstOrCreate([
                'session_key' => Session::token(),
            ]);
        }

        return view('cart', compact('order'));
    }

    public function cartDelete($id)
    {
        $product = OrderProduct::find($id);
        if (isset($product->id)) {
            OrderProduct::where('parent_id', $id)->delete();
            $product->delete();
        }
        return redirect()->route('cart');
    }

    public function userData()
    {
        if (isset(auth()->user()->id)) {

        } else {
            return redirect()->route('login');
        }
        $user = auth()->user();
        $order = $user->actualOrder;

        return view('data', compact('order', 'user'));
    }

    public function saveOrder(Request $request)
    {
        if (!$request->has('terms')) {
            return redirect()->back();
        }
        $user = auth()->user();
        $user->street = $request->street;
        $user->city = $request->city;
        $user->zip_code = $request->zip_code;
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->save();


        $order = $user->actualOrder;

        if (is_null($order) || !$order->checkAmounts()) {
            $checkAmounts = true;
            return redirect()->back();
        }

        $order->status = 2;
        $order->invoice = 0;

        if ($request->has('invoice')) {
            $user->street_invoice = $request->street_invoice;
            $user->city_invoice = $request->city_invoice;
            $user->zip_code_invoice = $request->zip_code_invoice;
            $user->name_invoice = $request->name_invoice;
            $user->nip_invoice = $request->nip_invoice;
            $user->save();

            $order->invoice = 1;
        }

        $order->save();

        foreach ($order->orderProducts as $orderProduct) {
            $orderProduct->changeStatus(2);
            $orderProduct->product->reduceAmount($orderProduct->amount);
        }
        $conf = Configuration::where('id', '>', 0)->first();

        if ($conf->turn_on_baselinker == 1)
            event(new CompleteOrderEvent($order));

        return view('complete', compact('order'));
    }

    public function createPDF(Order $order)
    {
        if ($order->user_id != auth()->user()->id || $order->user_id == null)
            return redirect()->route('index');

        $user = auth()->user();
        $view = view('admin.order.pdf_content', compact('order', 'user'));

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view->render());
        return $pdf->download();
    }

    public function terms()
    {
        dd('Tu będzie regulamin');
    }
}

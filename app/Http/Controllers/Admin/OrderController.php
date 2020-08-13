<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class OrderController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $p = Input::get('p');

        if ($p != "") {

            $sql = Order::query();
            $sql->leftJoin('users', 'users.id', '=', 'orders.user_id')->where('email', 'LIKE', '%' . $p . '%');

            $orders = $sql->where('status', '>', 1)->orderBy('orders.id', 'desc')->paginate(50)->setPath('');

            $pagination = $orders->appends(array(
                'p' => Input::get('p'),
            ));
            $count = count($orders);
            if ($count > 0)
                return view('admin.order.list', compact('orders', 'p'))->withDetails($orders)->withQuery($p);
            else {
                return view('admin.order.list', compact('orders', 'p'))->with('message', 'Nie znaleziono żadnych zamówień !');
            }
        }

        $orders = Order::where('status', '>', 1)->orderBy('id', 'desc')->paginate(50);
        return view('admin.order.list', compact('orders', 'p'));
    }

    public function details(Order $order)
    {
        /* if ($order->user_id != auth()->user()->id || $order->user_id == null)
             return redirect()->route('index');*/
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

    public function edit(Order $order)
    {
        return view('admin.order.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        if ($request->has('date_from') && !is_null($request->date_from)) {
            $order->date_from = $request->date_from;
            $order->save();
        }
        return redirect()->route('admin.order.details', ['order' => $order->id]);
    }

    public function send(Order $order)
    {
        $path = public_path('images/Podpis_0.png');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
       // dd($base64);
        foreach($order->orderProducts as $orderProduct){
            if(is_null($orderProduct->series) && $orderProduct->product->status==1){
                return back()->with(['series' => true]);
            }
        }


        $user = \App\Models\User::find($order->user_id);
        $view = view('admin.order.pdf_content', compact('order', 'user', 'base64'));


        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view->render());

        //return $pdf->stream();
        Mail::send('mails.body', array('test'=>1), function ($message) use ($order, $pdf) {
            $message->to($order->user->email, $name = $order->name);
         //   $message->to('gerardxlfc@gmail.com', $name = null);
            $message->from(env('MAIL_USERNAME'));
            $message->attachData($pdf->output(), "umowa.pdf");
            $message->subject('Rehastore - umowa do podpisania');
        });

        $order->send = 1;
        $order->save();

        return back()->with(['send' => true]);
    }

}

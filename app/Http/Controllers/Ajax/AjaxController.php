<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AjaxController extends Controller
{
    public function addProduct(Request $request)
    {
        $params = [];

        parse_str($request->form, $params);
        $checkAmount = true; //Dostępna ilość produktów
        $checkAmountAdditional = true; //Dostępna ilość elektrod
        $inputAmount = true; //poprawna liczba ilości
        $inputAmountAdditional = true; //poprawna liczba ilości elektrod
        $inputDays = true; //poprawna liczba dni
        $inputProducts = true; //zaznaczono produkt
        $inputAdditionals = true; //zaznaczono elektrody
        $addedToCart = false;

        if (!isset($params['days']) || $params['days'] <= 0) {
            $inputDays = false;
        }
        if (!isset($params['amount']) || $params['amount'] <= 0) {
            $inputAmount = false;
        }

        if (isset($params['product'])) {
            $product = Product::find($params['product']);
            if ($product->checkAmount($params['amount'])) {
                $checkAmount = true;
            } else {
                $checkAmount = false;
            }
        } else {
            $inputProducts = false;
        }

        if (isset($params['additional'])) {
            foreach ($params['additional'] as $additional) {
                $product = Product::find($additional);
                if ($product->checkAmount($params['amount_additional'][$additional])) {
                    $checkAmountAdditional = true;
                } else {
                    $checkAmountAdditional = false;
                }
            }
        } else {
            $inputAdditionals = false;
        }
        if ($inputAmount && $inputDays && $inputProducts && $checkAmount) {

            /*if ($inputAdditionals && !($inputAmountAdditional || $checkAmountAdditional)) {

            }*/

            if (isset(auth()->user()->id)) {
                $userId = auth()->user()->id;
                $now = Carbon::now();
                $from = Carbon::now();
                $to = $now->addDays($params['days']);
                $order = Order::firstOrCreate([
                    'user_id' => $userId,
                    'status' => 1,
                ], [
                    'date_from' => $from,
                    'date_to' => $to
                ]);

            } else {

                $sessionKey = Session::token();
                $now = Carbon::now();
                $from = Carbon::now();
                $to = $now->addDays($params['days']);
                $order = Order::firstOrCreate([
                    'session_key' => $sessionKey,
                    'status' => 1,
                ], [
                    'date_from' => $from,
                    'date_to' => $to
                ]);

            }

            $product = Product::find($params['product']);
            $orderProduct = OrderProduct::create([
                'order_id' => $order->id,
                'days' => $params['days'],
                'product_id' => $params['product'],
                'amount' => $params['amount'],
                'price' => $product->price($params['days'], $params['amount']),
                'status' => 1
            ]);
            if ($inputAdditionals && $inputAmountAdditional && $checkAmountAdditional) {
                foreach ($params['additional'] as $additional) {
                    $product = Product::find($additional);
                    $orderProduct = OrderProduct::create([
                        'order_id' => $order->id,
                        'product_id' => $additional,
                        'amount_additional' => $params['amount_additional'][$additional],
                        'days' => $params['days'],
                        'price' => $product->priceAdditional($params['amount_additional'][$additional]),
                        'status' => 1
                    ]);
                }

            }
            $addedToCart = true;

        }
        return response()->json(['view' => true, 'checkAmount' => $checkAmount, 'inputAmount' => $inputAmount,
            'inputDays' => $inputDays, 'inputProducts' => $inputProducts, 'checkAmountAdditional' => $checkAmountAdditional, 'addedToCart' => $addedToCart]);

    }

    public function getPrice(Request $request)
    {
        $params = [];

        parse_str($request->form, $params);
        $days = $params['days'];
        $amount = $params['amount'];

        $price = 0;
        if (isset($params['product'])) {
            $product = Product::find($params['product']);
            $price = $price + $product->price($days, $amount);
        }

        if (isset($params['additional'])) {
            foreach ($params['additional'] as $additional) {
                $amountAdditional = $params['amount_additional'][$additional];
                $additional = Product::find($additional);
                $price = $price + $additional->priceAdditional($amountAdditional);
            }

        }

        return response()->json(['price' => $price]);
    }

    public function updateAmount(Request $request)
    {
        $orderProduct = OrderProduct::find($request->product);
        $orderProduct->amount = $request->amount;
        $orderProduct->save();

        $product = $orderProduct->product;


        if ($product->status == 1) {
            $orderProduct->price = $product->price($orderProduct->days, $orderProduct->amount);
        } else {
            $orderProduct->price = $product->priceAdditional($orderProduct->amount);
        }

        $orderProduct->save();

        $order = $orderProduct->order;
        $order->total_price = $order->price();
        $order->save();

        return response()->json(['price' => $orderProduct->price, 'id' => $orderProduct->id, 'total_price' => $order->total_price]);
    }

    public function updateDays(Request $request)
    {
        $orderProduct = OrderProduct::find($request->product);
        $orderProduct->days = $request->days;
        $orderProduct->save();

        $product = $orderProduct->product;
        $orderProduct->price = $product->price($orderProduct->days, $orderProduct->amount);
        $orderProduct->save();

        $order = $orderProduct->order;
        $order->total_price = $order->price();
        $order->save();

        return response()->json(['price' => $orderProduct->price, 'id' => $orderProduct->id, 'total_price' => $order->total_price]);
    }

}

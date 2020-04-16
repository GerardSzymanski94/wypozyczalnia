<?php

namespace App\Console\Commands;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class CheckOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wypozyczalnia:orders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sprawdzanie dat oddania sprzętu i wysłanie maila z przypomnieniem';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $orders = Order::whereStatus(2)->get();
        $email = "";
        foreach ($orders as $order) {
            $data = [];
            $email = $order->user->email;
            foreach ($order->orderProducts as $orderProduct) {
                $date = Carbon::parse($orderProduct->created_at);
                $date->addDays($orderProduct->days);
                $now = Carbon::now();

                $term = Carbon::now()->addDays(7);


                if ($date < $term && $date > $now && $orderProduct->product->status == 1) {
                    $data['products'][] = ['name' => $orderProduct->product->name, 'date' => $date];
                }
            }

            if (count($data) > 0) {
                $content = view('mails.alert')->with(['products' => $data['products']])->render();
                \App\Models\Mail::create(['user_id' => $order->user->id, 'email' => $email, 'content' => $content, 'status' => 1]);

                Mail::send('mails.alert', $data, function ($message) {
                    $message->to('g.szymanski@netoholics.net', $name = null);
                    $message->from('productbase@dev.netoholics.net');
                    $message->subject('Przypomnienie o produktach');
                });
            }
        }

    }
}

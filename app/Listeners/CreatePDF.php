<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\App;

class CreatePDF
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object $event
     * @return void
     */
    public function handle($event)
    {
        $order = $event->order;
        $user = $event->user;
        $view = view('admin.order.pdf_content', compact('order', 'user'));

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view->render());
        app('debugbar')->info($pdf);
        return $pdf->download();
        // return view('cart', compact('order'));
    }
}

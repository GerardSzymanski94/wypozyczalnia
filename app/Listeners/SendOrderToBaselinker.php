<?php

namespace App\Listeners;

use App\Repository\BaselinkerApiRepository;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendOrderToBaselinker
{

    private $repo;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->repo = new BaselinkerApiRepository();
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
        $this->repo->addOrder($order);
    }
}

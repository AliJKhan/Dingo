<?php

namespace App\Mail;

use App\orders;
use App\owned_cars;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderPlaced extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var Order
     */
    protected $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(orders $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $orderItems = $this->order->getItems();

        $ownedCar = owned_cars::find($this->order->owned_car_id)->first();
        return  $this->view('orders.invoice')
            ->with('order',$this->order)
            ->with('orderItems',$orderItems)
            ->with('ownedCar',$ownedCar);
    }
}

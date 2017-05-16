<?php

namespace App\Http\Controllers;

use App\mechanic;
use App\order_items;
use App\orders;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index(Request $request)
    {
        $orders = orders::all();


        return view('orders.index')
            ->with('orders',$orders);

    }

    public function viewOrders(Request $request)
    {

        $order = orders::find($request->id);

        $orderItems = $order->getItems();

        return view('orders.invoice')
            ->with('order',$order)
            ->with('orderItems',$orderItems);

    }


    public function editOrders(Request $request)
    {

        $order = orders::find($request->id);
        $orderItems = $order->getItems();

        $mechanics = mechanic::all();

        return view('orders.edit')
            ->with('order',$order)
            ->with('mechanics',$mechanics)
            ->with('orderItems',$orderItems);

    }
    public function updateOrders(Request $request)
    {

        $order = orders::find($request->id);
        $orderItems  = $order->getItems();
        $orderSubTotal=0;


        $i=0;
        foreach ($orderItems as $item) {
            $item->discount_amount = $request->discountPrices[$i];
            $item->after_discount_price = $request->total[$i];
            $orderSubTotal += $request->total[$i];
            $item->save();
            $i++;
        }

        $order->subtotal = $orderSubTotal;
        $order->discount_amount = $request->orderDiscount;
        $order->after_discount_price = $orderSubTotal-($request->orderDiscount);

        if($order->order_status_id==1 && $request->mechanic!=0){
        $order->mechanic_id = $request->mechanic;
        $order->order_status_id = 2;
        }
        $order->mechanic_id = $request->mechanic;


        if(isset($request->status))
        $order->order_status_id = $request->status;

        $order->save();
        return redirect()->route('orders');


    }


}

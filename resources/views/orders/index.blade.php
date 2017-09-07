@extends('layouts.headers')
@extends('layouts.navbar')


<div class="container">
    <div class="row">
        <div class="span5">
            <table class="table table-striped table-condensed">
                <h3>Orders</h3>
                <a href="{{route('newOrders')}}" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-plus-sign"></span> Add</a>
                <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{$order->id}}</td>
                        <td>{{$order->getUser()}}</td>
                        @if($order->order_status_id==1)
                            <td><span class="label label-primary">New</span></td>
                        @elseif($order->order_status_id==2)
                            <td><span class="label label-default">Mechanic Assigned</span></td>
                        @elseif($order->order_status_id==3)
                            <td><span class="label label-default">Mechanic Dispatched</span></td>
                        @elseif($order->order_status_id==4)
                            <td><span class="label label-warning">Payment Pending</span></td>
                        @elseif($order->order_status_id==5)
                            <td><span class="label label-success">Payment Received</span></td>
                        @endif


                        <td>{{$order->created_at->format('w F Y H:i:s')}}</td>

                        <td ><a href="{{route('viewOrders', ['id' =>$order->id])}}" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-edit"></span> View</a>
                            @if($order->order_status_id!=5)
                                <a href="{{route('editOrders', ['id' =>$order->id])}}" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
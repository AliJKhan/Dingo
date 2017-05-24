@extends('layouts.headers')

<div class="container">
<div id="invoice" >
    <div class="row">
        <div class="col-xs-12">
            <div class="invoice-title">
                <h2>Invoice</h2><h3 class="pull-right">Order # {{$order->id}}</h3>
            </div>
            <hr>
            <div class="row">
                <div class="col-xs-6">
                    <address>
                        <strong>Billed To:</strong><br>
                        John Smith<br>
                        1234 Main<br>
                        Apt. 4B<br>
                        Springfield, ST 54321
                    </address>
                </div>
                <div class="col-xs-6 text-right">
                    <address>
                        <strong>Car Info</strong><br>
                        {{$ownedCar->make_name}}<br>
                        {{$ownedCar->model_name}}<br>
                        {{$ownedCar->year}}<br>
                        {{$ownedCar->registration_number}}
                    </address>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <address>
                        <strong>Payment Method:</strong><br>
                        Visa ending **** 4242<br>
                        jsmith@email.com
                    </address>
                </div>
                <div class="col-xs-6 text-right">
                    <address>
                        <strong>Order Date:</strong><br>
                        {{$order->created_at->format('d F Y')}}<br><br>
                    </address>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Order summary</strong></h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                            <tr>
                                <td><strong>Item</strong></td>
                                <td class="text-center"><strong>Price</strong></td>
                                <td class="text-center"><strong>Discount</strong></td>
                                <td class="text-center"><strong>Total</strong></td>
                            </tr>
                            </thead>
                            <tbody>
                            <!-- foreach ($order->lineItems as $line) or some such thing here -->
                            @foreach($orderItems as $item)
                            <tr>
                                <td>{{$item->getServiceName()}}</td>
                                <td class="text-center">{{$item->service_orignal_price}}</td>
                                <td class="text-center">{{$item->discount_amount}}</td>
                                <td class="text-right">{{$item->after_discount_price}}</td>
                            </tr>

                            @endforeach
                            <tr>
                                <td class="thick-line"></td>
                                <td class="thick-line"></td>
                                <td class="thick-line text-center"><strong>Subtotal</strong></td>
                                <td class="thick-line text-right">{{$order->subtotal}}</td>
                            </tr>
                            <tr>
                                <td class="no-line"></td>
                                <td class="no-line"></td>
                                <td class="no-line text-center"><strong>Discount</strong></td>
                                <td class="no-line text-right">{{$order->discount_amount}}</td>
                            </tr>
                            <tr>
                                <td class="no-line"></td>
                                <td class="no-line"></td>
                                <td class="no-line text-center"><strong>Total</strong></td>
                                <td class="no-line text-right">{{$order->after_discount_price}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <button onclick="print()">Print </button>

</div>
</div>

@extends('layouts.headers')
@extends('layouts.navbar')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<form method="post" action="{{route('updateOrders')}}">
<div class="container">
    <div class="row">
        <br>
        <div class="col-md-12">
            <div class="col-md-4 col-sm-6 col-xs-12 col-md-push-6 col-sm-push-6">
                <!--REVIEW ORDER-->
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <h4>Review Order</h4>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <strong>Subtotal </strong>
                            <div class="pull-right" id="orderSubtotal">{{$order->subtotal}}</div>
                        </div>
                        {{--<div class="col-md-12">
                            <strong>Tax</strong>
                            <div class="pull-right"><span>$</span><span>200.00</span></div>
                        </div>--}}
                        <div class="col-md-12">
                            <small>Discount</small>
                            <div class="pull-right col-xs-3 "><input type="text" class="input-sm  form-control"  name="orderDiscount" value="{{$order->discount_amount}}" id="orderDiscount"></div>
                            <hr>
                        </div>
                        <div class="col-md-12">
                            <strong>Order Total</strong>
                            <div class="pull-right" id="orderTotal">{{$order->after_discount_price}}</div>
                            <hr>
                        </div>
                        @if($order->mechanic_id!=0)
                            <div class="form-group">
                            <label for="mechanic">Mechanic</label>
                            <select class="form-control"  name="mechanic" disabled>
                                 <option value="{{$order->mechanic_id}}" selected>{{$order->getMechanicName()}}</option>

                            </select>
                                <input type="hidden" name="mechanic" value="{{$order->mechanic_id}}" />
                        </div>
                        @else
                        <div class="form-group">
                            <label for="mechanic">Mechanic</label>
                            <select class="form-control"  name="mechanic">
                                <option value="0" selected></option>
                                @foreach($mechanics as $mechanic)

                                    @if($order->mechanic_id==$mechanic->id)
                                        <option value="{{$mechanic->id}}" selected>{{$mechanic->name}}</option>
                                    @else
                                        <option value="{{$mechanic->id}}">{{$mechanic->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                       @endif


                        @if($order->order_status_id == 1)
                        <div class="checkbox" >
                            <label><input type="checkbox" value="2" name="status"> Mechanic Assigned</label>
                        </div>
                        <div class="checkbox disabled" >
                            <label><input type="checkbox" value="3" disabled>Mechanic Dispatched</label>
                        </div>
                        <div class="checkbox disabled">
                            <label><input type="checkbox" value="4" disabled>Payment Pending</label>
                        </div>
                        <div class="checkbox disabled">
                            <label><input type="checkbox" value="5" disabled>Payment Recieved</label>
                        </div>
                        @elseif($order->order_status_id == 2)
                            <div class="checkbox disabled">
                                <label><input type="checkbox" value="2" checked disabled>Mechanic Assigned</label>
                            </div>
                            <div class="checkbox " >
                                <label><input type="checkbox" value="3" name="status">Mechanic Dispatched</label>
                            </div>
                            <div class="checkbox disabled">
                                <label><input type="checkbox" value="4" disabled>Payment Pending</label>
                            </div>
                            <div class="checkbox disabled">
                                <label><input type="checkbox" value="5" disabled>Payment Recieved</label>
                            </div>

                        @elseif($order->order_status_id == 3)
                            <div class="checkbox disabled">
                                <label><input type="checkbox" value="2" checked disabled>Mechanic Assigned</label>
                            </div>
                            <div class="checkbox disabled" >
                                <label><input type="checkbox" value="3" checked disabled>Mechanic Dispatched</label>
                            </div>
                            <div class="checkbox ">
                                <label><input type="checkbox" value="4" name="status">Payment Pending</label>
                            </div>
                            <div class="checkbox disabled">
                                <label><input type="checkbox" value="5" disabled>Payment Recieved</label>
                            </div>
                        @elseif($order->order_status_id == 4)
                            <div class="checkbox disabled">
                                <label><input type="checkbox" value="2" checked disabled>Mechanic Assigned</label>
                            </div>
                            <div class="checkbox disabled" >
                                <label><input type="checkbox" value="3" checked disabled>Mechanic Dispatched</label>
                            </div>
                            <div class="checkbox disabled">
                                <label><input type="checkbox" value="4" checked disabled>Payment Pending</label>
                            </div>
                            <div class="checkbox ">
                                <label><input type="checkbox" value="5" name="status">Payment Recieved</label>
                            </div>
                        @elseif($order->order_status_id == 5)
                            <div class="form-group">

                                <div class="col-md-4">
                                    <button class="btn btn-info" >Order Closed</button>
                                </div>
                            </div>
                        @endif



                    </div>

                </div>
                <!--REVIEW ORDER END-->
            </div>
            <div class="col-md-8 col-sm-6 col-xs-12 col-md-pull-6 col-sm-pull-6">
                <!--SHIPPING METHOD-->
                <div class="panel panel-default">
                    <div class="panel-heading text-center"><h4>Current Cart</h4></div>
                    <div class="panel-body">
                        <table class="table borderless">
                            <thead>
                            <tr>
                                <td><strong>Your Cart: </strong></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($orderItems as $item)
                                <tr>
                                    <td class="col-md-3">
                                        <div class="media">
                                            <a class="thumbnail pull-left" href="#"> <img class="media-object"  style="width: 72px; height: 72px;"> </a>
                                            <div class="media-body">

                                                <h5 class="media-heading">{{$item->service_name}} </h5>

                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center" ><span id="unitPrice-{{$item->id}}">{{$item->service_orignal_price}}</span></td>

                                    <td class="text-center"> <div class="col-xs-6"><input type="text" class="form-control" id="discountPrice-{{$item->id}}" name="discountPrices[]" value="{{$item->discount_amount}}" ></div></td>
                                    <td class="text-center" ><input type="text" class="form-control" id="total-{{$item->id}}" name="total[]" value="{{$item->after_discount_price}}" readonly>                                     </td>
                                    {{--     <td class="text-right"><button type="button" class="btn btn-danger" disabled>Remove</button></td> --}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--SHIPPING METHOD END-->
            </div>
        </div>
    </div>

</div>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="id" value="{{ $order->id }}">
    <!-- Button -->
    <div class="form-group">

        <div class="col-md-4">
            <input type="submit" class="btn btn-submit" value="Submit">
        </div>
    </div>
</form>



<style type="text/css">
    a[class="disabled"] {
        pointer-events: none;
        color: grey;
    }
</style>


<script>

    $(function() {

        @foreach($orderItems as $item)
              jQuery('#discountPrice{{-$item->id}}').on('input propertychange paste', function() {
                $('#total{{-$item->id}}').val($('#unitPrice{{-$item->id}}').html()-$('#discountPrice-{{$item->id}}').val());
            });
        @endforeach

         jQuery('#orderDiscount').on('input propertychange paste', function() {
            $('#orderTotal').html($('#orderSubtotal').html()-$('#orderDiscount').val());
        });
    });
</script>



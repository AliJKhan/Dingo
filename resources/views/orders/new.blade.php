@extends('layouts.headers')
@extends('layouts.navbar')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<form class="form-horizontal" method="post" action="{{route('postOrders')}}">
    <div class="form-group" id="serviceDiv">
        <label class="col-md-4 control-label" for="models">Service:</label>
        <div class="col-md-4 ">
            <select name="service_id" class="form-control" id="services" >
                <option value=""></option>
                @foreach($services as $service)
                    <option value="{{$service->id}}" data-classification="{{$service->classification}}">{{$service->name}}</option>
                @endforeach
            </select>
        </div>
    </div>


    <div class="form-group" id="oilBrandsDiv">
        <label class="col-md-4 control-label" for="models">Oil :</label>
        <div class="col-md-4 ">
            <select name="oil_brand_id" class="form-control" id="oilBrands" >
                <option value=""></option>
                @foreach($oilBrands as $oil)
                    <option value="{{$oil->id}}" >{{$oil->name}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group" id="airFiltersDiv">
        <label class="col-md-4 control-label" for="models">Air Filter:</label>
        <div class="col-md-4 ">
            <select name="air_filters_id" class="form-control" id="airFilters" >
                <option value=""></option>
                @foreach($airFilters as $filter)
                    <option value="{{$filter->id}}" >{{$filter->name}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group" id="oilFiltersDiv">
        <label class="col-md-4 control-label" for="models">Oil Filter:</label>
        <div class="col-md-4 ">
            <select name="oil_filter_id" class="form-control" id="oilFilters" >
                <option value=""></option>
                @foreach($oilFilters as $filter)
                    <option value="{{$filter->id}}" >{{$filter->name}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group" id="batteryDiv">
        <label class="col-md-4 control-label" for="models">Battery:</label>
        <div class="col-md-4 ">
            <select name="battery_id" class="form-control" id="batteries" >
                <option value=""></option>
                @foreach($batteryBrands as $brand)
                    <option value="{{$brand->id}}" >{{$brand->name}}</option>
                @endforeach
            </select>
        </div>
    </div>


    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <!-- Button -->
    <div class="form-group">
        <label class="col-md-4 control-label" for="singlebutton"></label>
        <div class="col-md-4">
            <input type="submit" value="Submit">
        </div>
    </div>
</form>

<script>
    $(function() {

       /* $('#oilBrandsDiv').hide();
        $('#airFiltersDiv').hide();
        $('#oilFiltersDiv').hide();
        $('#batteryDiv').hide();
      */
        $('#services').change(function(){
            console.log($('#services').find(':selected').data('classification'));

        });

    });

</script>
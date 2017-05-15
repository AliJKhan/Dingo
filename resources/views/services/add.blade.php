@extends('layouts.headers')
@extends('layouts.navbar')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<div class="container">
    <form class="form-horizontal" method="post" action="{{route('newService')}}">
        <fieldset>
            <div class="form-group ">
                <label class="col-md-4 control-label" for="selectMe">Select list:</label>
                <div class="col-md-4 ">
                    <select name="selection" class="form-control" id="selectMe">
                        <option value="1">Service</option>
                        <option value="2">Battery </option>
                        <option value="3">Air Filter</option>
                        <option value="4">Oil Filter</option>
                        <option value="5">Brake Pad</option>
                        <option value="6">Model and Year Battery </option>
                        <option value="7">Battery Amps</option>
                        <option value="8">Model and Year Services</option>
                        <option value="9">Air Filter Brands</option>
                        <option value="10">Oil Filter Brands</option>
                        <option value="11">Brake Pad Brands</option>
                        <option value="12">Oil Brands</option>
                        <option value="13">Oil Capacity</option>

                    </select>
                </div>
            </div>
            <!-- Text input-->
            <div class="form-group" id="nameDiv">
                <label class="col-md-4 control-label" for="textinput">Name</label>
                <div class="col-md-4">
                    <input id="textinput" name="objectName" type="text" placeholder="" class="form-control input-md" value="">

                </div>
            </div>


            <div class="form-group" id="brakePadsDiv">
                <label class="col-md-4 control-label" for="models">Brake Pads:</label>
                <div class="col-md-4 ">
                    <select name="brakePads" class="form-control" id="brakePads" >
                        <option value=""></option>
                        @foreach($brakePads as $brakePad)
                            <option value="{{$brakePad->id}}">{{$brakePad->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="form-group" id="airFilterDiv">
                <label class="col-md-4 control-label" for="models">Air Filters:</label>
                <div class="col-md-4 ">
                    <select name="airFilter" class="form-control" id="airFilter" >
                        <option value=""></option>
                        @foreach($airFilters as $airFilter)
                            <option value="{{$airFilter->id}}">{{$airFilter->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="form-group" id="oilFilterDiv">
                <label class="col-md-4 control-label" for="models">Oil Filters:</label>
                <div class="col-md-4 ">
                    <select name="oilFilter" class="form-control" id="oilFilter" >
                        <option value=""></option>
                        @foreach($oilFilters as $oilFilter)
                            <option value="{{$oilFilter->id}}">{{$oilFilter->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group " id="serviceDiv">
                <label class="col-md-4 control-label" for="years">Services:</label>
                <div class="col-md-4 ">
                    <select name="serviceSelect" class="form-control" id="serviceSelect" >
                        @foreach($services as $service)
                            <option value="{{$service->id}}">{{$service->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group" id="batteriesDiv">
                <label class="col-md-4 control-label" for="models">Select Battery:</label>
                <div class="col-md-4 ">
                    <select name="battery" class="form-control" id="battery" >
                        <option value=""></option>
                        @foreach($batteries as $battery)
                            <option value="{{$battery->id}}">{{$battery->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group" id="modelSelect">
                <label class="col-md-4 control-label" for="models">Select Model:</label>
                <div class="col-md-4 ">
                    <select name="car_models" class="form-control" id="car_models" >
                        <option value=""></option>
                        @foreach($models as $model)
                            <option value="{{$model->id}}">{{$model->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group " id="yearFDiv">
                <label class="col-md-4 control-label" for="years">Year From:</label>
                <div class="col-md-4 ">
                    <select name="yearFrom" class="form-control" id="yearFrom" >

                    </select>
                </div>
            </div>



            <div class="form-group " id="yearTDiv">
                <label class="col-md-4 control-label" for="years">Year To:</label>
                <div class="col-md-4 ">
                    <select name="yearTo" class="form-control" id="yearTo" >

                    </select>
                </div>
            </div>

            <div class="form-group " id="ampsDiv">
                <label class="col-md-4 control-label" for="years">Amps:</label>
                <div class="col-md-4 ">
                    <select name="ampsSelect" class="form-control" id="ampsSelect" >
                        @foreach($amps as $amp)
                            <option value="{{$amp->amps}}">{{$amp->amps}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- Text input-->
            <div class="form-group" id="ampere">
                <label class="col-md-4 control-label" for="textinput">Amps</label>
                <div class="col-md-4">
                    <input id="textinput" name="amps" type="text" placeholder="" class="form-control input-md" value="" >

                </div>
            </div>
            <!-- Text input-->
            <div class="form-group" id="priceDiv">
                <label class="col-md-4 control-label" for="textinput" >Price</label>
                <div class="col-md-4">
                    <input id="textinput" name="price" type="text" placeholder="2000" class="form-control input-md" value="" >


                </div>
            </div>

            <!-- Text input-->
            <div class="form-group" id="capacityDiv">
                <label class="col-md-4 control-label" for="textinput" >Capacity</label>
                <div class="col-md-4">
                    <input id="capacity" name="capacity" type="text" placeholder="10" class="form-control input-md" value="" >


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

        </fieldset>
    </form>

</div>

<script type="text/javascript">
    $(function() {

        $('#ampere').hide();
        $('#ampsDiv').hide();
        $('#modelSelect').hide();
        $('#yearFDiv').hide();
        $('#yearTDiv').hide();
        $('#batteriesDiv').hide();
        $('#priceDiv').hide();
        $('#serviceDiv').hide();
        $('#airFilterDiv').hide();
        $('#oilFilterDiv').hide();
        $('#brakePadsDiv').hide();
        $('#capacityDiv').hide();


        $('#selectMe').change(function(){
            $('#ampere').hide();
            $('#ampsDiv').hide();
            $('#modelSelect').hide();
            $('#yearFDiv').hide();
            $('#yearTDiv').hide();
            $('#batteriesDiv').hide();
            $('#priceDiv').hide();
            $('#serviceDiv').hide();
            $('#airFilterDiv').hide();
            $('#oilFilterDiv').hide();
            $('#brakePadsDiv').hide();
            $('#capacityDiv').hide();

        });


        $('#selectMe').change(function(){
            if($('#selectMe').val() == 1) {

              } else {

            }
        });

        $('#selectMe').change(function(){
            if($('#selectMe').val() == 2) {



            } else {


            }
        });

        $('#selectMe').change(function(){
            if( $('#selectMe').val() == 3 ) {

            } else {


            }
        });

        $('#selectMe').change(function(){
            if( $('#selectMe').val() == 4 ) {

            } else {


            }
        });

        $('#selectMe').change(function(){
            if( $('#selectMe').val() == 5 ) {

            } else {


            }
        });

        $('#selectMe').change(function(){
            if($('#selectMe').val() == 6) {
                $('#ampsDiv').show();
                $('#modelSelect').show();
                $('#nameDiv').hide();
                $('#priceDiv').hide();


            } else {
                $('#nameDiv').show();


            }
        });

        $('#selectMe').change(function(){
            if($('#selectMe').val() == 7) {
                $('#batteriesDiv').show();
                $('#nameDiv').hide();
                $('#ampere').show();
                $('#priceDiv').show();

            } else {



            }
        });

        $('#selectMe').change(function(){
            if($('#selectMe').val() == 8) {
                $('#modelSelect').show();
                $('#nameDiv').hide();
                $('#serviceDiv').show();
            $('#priceDiv').show();

            } else {

            }
        });

        $('#selectMe').change(function(){
            if($('#selectMe').val() == 9) {
                $('#airFilterDiv').show();
                $('#nameDiv').hide();
                $('#priceDiv').show();
                $('#modelSelect').show();


            } else {

            }
        });

        $('#selectMe').change(function(){
            if($('#selectMe').val() == 10) {
                $('#oilFilterDiv').show();
                $('#nameDiv').hide();
                $('#priceDiv').show();
                $('#modelSelect').show();


            } else {

            }
        });

        $('#selectMe').change(function(){
            if($('#selectMe').val() == 11) {
                $('#brakePadsDiv').show();
                $('#nameDiv').hide();
                $('#priceDiv').show();
                $('#modelSelect').show();


            } else {

            }
        });


        $('#selectMe').change(function(){
            if($('#selectMe').val() == 13) {
                $('#modelSelect').show();
                $('#nameDiv').hide();
                $('#capacityDiv').show();


            } else {

            }
        });



        $('#car_models').change(function(){

            $('#yearFrom').empty();
            $('#yearTo').empty();

            $.ajax({
                url: '{{route('modelnyear')}}',
                data: {
                    'model_id': $('#car_models').val()
                },
                error: function() {
                    $('#info').html('<p>An error has occurred</p>');
                },
                dataType: 'json',
                success: function(result) {
                    var yearFrom = $("#yearFrom");
                    var yearTo = $("#yearTo");

                    console.log(result);
                    $.each(result.data, function(key, value) {

                        yearFrom.append($("<option />").val(value.id).html(value.name));
                        yearTo.append($("<option />").val(value.id).html(value.name));

                    });
                    $('#yearFDiv').show();
                    $('#yearTDiv').show();
                },
                type: 'GET'
            });


        });

    });
</script>
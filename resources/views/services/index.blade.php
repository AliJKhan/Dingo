@extends('layouts.headers')
@extends('layouts.navbar')



<a href="{{route('addService')}}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-plus"></span> Add</a>

<div class="container">
    <div class="row">
        <div class="span5">
            <table class="table table-striped table-condensed">
                <h3>Services</h3>
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Action</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($services as $service)
                    <tr>
                        <td> {{$service->name}}</td>
                        <td>{{$service->price}}</td>
                        <td ><a href="{{route('editService', ['id' => $service->id,'type'=>1])}}" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                            <a href="{{route('deleteService', ['id' => $service->id,'type'=>1])}}" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-minus"></span> Delete</a></td>
                        <td><span class="label label-success">Active</span>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="span5">
            <table class="table table-striped table-condensed">
                <h3>Battery</h3>
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Amps</th>
                    <th>Action</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($batteryBrands as $battery)
                    <tr>
                        <td> {{$battery->name}}</td>
                        <td>{{$battery->price}}</td>
                        <td >{{$battery->amps}}</td>
                        <td ><a href="{{route('editService', ['id' => $battery->id,'type'=>2])}}" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-edit"></span> Edit</a></td>
                        <td><span class="label label-info">In Stock</span>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="span5">
            <table class="table table-striped table-condensed">
                <h3>Air Filter</h3>
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Action</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($airFilters as $airFilter)
                    <tr>
                        <td> {{$airFilter->name}}</td>
                        <td>{{$airFilter->price}}</td>
                        <td ><a href="{{route('editService', ['id' => $airFilter->id,'type'=>3])}}" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-edit"></span> Edit</a></td>
                        <td><span class="label label-danger">Empty</span>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="span5">
            <table class="table table-striped table-condensed">
                <h3>Oil Filter</h3>
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Action</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($oilFilters as $oilFilter)
                    <tr>
                        <td> {{$oilFilter->name}}</td>
                        <td>{{$oilFilter->price}}</td>
                        <td ><a href="{{route('editService', ['id' => $oilFilter->id,'type'=>4])}}" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-edit"></span> Edit</a></td>
                        <td><span class="label label-danger">Empty</span>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="span5">
            <table class="table table-striped table-condensed">
                <h3>Brake Pad</h3>
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Action</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($brakePadBrands as $brakePad)
                    <tr>
                        <td> {{$brakePad->name}}</td>
                        <td>{{$brakePad->price}}</td>
                        <td ><a href="{{route('editService', ['id' => $brakePad->id,'type'=>5])}}" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-edit"></span> Edit</a></td>
                        <td><span class="label label-danger">Empty</span>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
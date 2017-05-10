@extends('layouts.headers')
@extends('layouts.navbar')



<a href="{{route('addService')}}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-plus"></span> Add</a>

<div class="container">
    <div class="row">
        <div class="span5">
            <table class="table table-striped table-condensed">
                <h3>Batteries</h3>
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
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
                {{ $batteryBrands->links() }}
                </tbody>
            </table>
        </div>
    </div>
</div>
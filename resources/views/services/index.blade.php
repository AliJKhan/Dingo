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

</div>

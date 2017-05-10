@extends('layouts.headers')
@extends('layouts.navbar')



<a href="{{route('addService')}}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-plus"></span> Add</a>

<div class="container">
    <div class="row">
        <div class="span5">
            <table class="table table-striped table-condensed">
                <h3>Break Pads</h3>
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Year</th>
                    <th>Action</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($brakePadBrands as $brakePad)
                    <tr>
                        <td> {{$brakePad->name}}</td>
                        <td>{{$brakePad->price}}</td>
                        <td>{{\App\modelnyear::find($brakePad->modelnyear_id)->getModel->getMake->name}}</td>
                        <td>{{\App\modelnyear::find($brakePad->modelnyear_id)->getModel->name}}</td>
                        <td>{{\App\modelnyear::find($brakePad->modelnyear_id)->getYear->name}}</td>
                        <td ><a href="{{route('editService', ['id' => $brakePad->id,'type'=>5])}}" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-edit"></span> Edit</a></td>
                        <td><span class="label label-danger">Empty</span>
                        </td>
                    </tr>
                @endforeach
                {{ $brakePadBrands->links() }}
                </tbody>
            </table>
        </div>
    </div>
</div>
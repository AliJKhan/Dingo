@extends('layouts.headers')
@extends('layouts.navbar')



<a href="{{route('addService')}}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-plus"></span> Add</a>

<div class="container">
    <div class="row">
        <div class="span5">
            <table class="table table-striped table-condensed">
                <h3>Air Filter</h3>
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

                @foreach($airFilters as $airFilter)
                    <tr>
                        <td>{{$airFilter->name}}</td>
                        <td>{{$airFilter->price}}</td>
                        <td>{{\App\modelnyear::find($airFilter->modelnyear_id)->getModel->getMake->name}}</td>
                        <td>{{\App\modelnyear::find($airFilter->modelnyear_id)->getModel->name}}</td>
                        <td>{{\App\modelnyear::find($airFilter->modelnyear_id)->getYear->name}}</td>
                        <td>{{$airFilter->price}}</td>
                        <td ><a href="{{route('editService', ['id' => $airFilter->id,'type'=>3])}}" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-edit"></span> Edit</a></td>
                        <td><span class="label label-danger">Empty</span>
                        </td>
                    </tr>
                @endforeach
                {{ $airFilters->links() }}
                </tbody>
            </table>
        </div>
    </div>
</div>
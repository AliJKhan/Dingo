@extends('layouts.headers')
@extends('layouts.navbar')


    <div class="row col-md-6 col-md-offset-2 custyle">
        <table class="table table-striped custab">
            <thead>
            @foreach ($users as $user)
            <tr>
                <th>{{$user->phone_number}}</th>

                <th class="text-center">Action</th>
            </tr>
            </thead>
               @foreach($user->getAllCars as $car)
                <tr>
                    <td>{{$car->model_name}}</td>
                    <td class="text-center"><a class='btn btn-info btn-xs' href="{{route('viewCar', ['id' => $car->id])}}"><span class="glyphicon glyphicon-search"></span> View</a> <a href="{{route('editCar', ['id' => $car->id])}}" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-edit"></span> Edit</a></td>
                </tr>
            @endforeach
            @endforeach

        </table>
    </div>

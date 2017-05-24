@extends('layouts.headers')
@extends('layouts.navbar')


<div class="container">
    <div class="row">
        <div class="span5">
            <table class="table table-striped table-condensed">
                <h3>Users</h3>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Number</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->first_name}} {{$user->last_name}} </td>
                        <td>{{$user->phone_number}}</td>
                        <td>{{$user->email}} </td>
                        <td >
                            <a href="{{route('editUsers',["id"=>$user->id])}}" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-edit"></span> Edit</a>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
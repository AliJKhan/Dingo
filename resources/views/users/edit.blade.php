

@extends('layouts.headers')
<div class="container">
    <form class="form-horizontal" method="post" action="{{route('updateUser',["id"=>$user->id])}}">
        <fieldset>

            <!-- Form Name -->
            <legend>Edit User</legend>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">First Name</label>
                <div class="col-md-4">
                    <input id="textinput" name="first_name" type="text" placeholder="" class="form-control input-md" value="{{$user->first_name}}">

                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Last Name</label>
                <div class="col-md-4">
                    <input id="textinput" name="last_name" type="text" placeholder="" class="form-control input-md" value="{{$user->last_name}}">

                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Email</label>
                <div class="col-md-4">
                    <input id="textinput" name="email" type="text" placeholder="2000" class="form-control input-md" value="{{$user->email}}" >


                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="textinput">Phone Number</label>
                <div class="col-md-4">
                    <input id="textinput" name="phone_number" type="text" placeholder="2000" class="form-control input-md" value="{{$user->phone_number}}" >


                </div>
            </div>

            @foreach($userPermissions as $permission => $value)
                <div class="form-group">
                    <label class="col-md-4 control-label" for="textinput">{{$permission}}</label>
                    <div class="col-md-4">
                        <label class="switch">
                            @if($value=="true")
                                <input name="permission[{{$permission}}]" type="hidden"  value="false" >
                                <input name="permission[{{$permission}}]" type="checkbox"  value="{{$value}}" checked>

                                <div class="slider round"></div>

                            @else
                                <input name="permission[{{$permission}}]" type="hidden"  value="false" >
                                <input name="permission[{{$permission}}]"  type="checkbox" value="true" >


                                <div class="slider round"></div>
                            @endif
                        </label>
                    </div>
                </div>
            @endforeach

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
<style>
    /* The switch - the box around the slider */
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    /* Hide default HTML checkbox */
    .switch input {display:none;}

    /* The slider */
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>
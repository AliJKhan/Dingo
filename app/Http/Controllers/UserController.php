<?php

namespace App\Http\Controllers;

use App\User;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {

        $users = User::all();
        return view('users.index')
            ->with('users',$users);

    }

    public function edit(Request $request)
    {

        $roles = Sentinel::getRoleRepository()->createModel()->where('slug', 'user')->get();

        $permissions = [];

        foreach ($roles as $role) {
            $permissions = array_merge($role->permissions, $permissions);
        }


        $user = User::find($request->id);
        $userPermissions = json_decode($user->permissions,true);



        if($userPermissions==NULL)
        {
            $userPermissions = $permissions;
        }
        elseif((sizeof($permissions)>sizeof($userPermissions))) {

            $result = array_merge($permissions,$userPermissions);


            $userPermissions = $result;
        }

        return view('users.edit')
            ->with('user',$user)
            ->with('userPermissions',$userPermissions);

    }

    public function update(Request $request)
    {


        $user = Sentinel::findById($request->id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone_number = $request->phone_number;
        $user->email = $request->email;


        foreach ($request->permission as $permisison => $value) {

            if($value=='true')
            {
                $user->updatePermission($permisison, true, true)->save();
                $user->save();
            }elseif($value=='false'){

                $user->updatePermission($permisison, false, true)->save();
                $user->save();
            }


        }

        return redirect()->action('UserController@index');

    }
}

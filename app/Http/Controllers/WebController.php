<?php

namespace App\Http\Controllers;
use App\owned_cars,
    Illuminate\Support\Facades\Validator,
    Illuminate\Support\Facades\Session;
use App\User;
use App\WebUser;
use Cartalyst\Sentinel\Activations\IlluminateActivationRepository as Auth;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class WebController extends Controller
{


    public function index(Request $request)
    {


        return view('welcome');

    }
    public function SignUp(Request $request)
    {


        return view('login.signup');

    }

    public function postStore(Request $request)
    {

        $rules = array('email' => 'unique:users,email');

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Session::flash('alert-warning', 'User Already Signed Up, Try Signing In');
            return redirect()->action('WebController@index');
        }
        else {
            $role = Sentinel::findRoleByName('Admin');

            $user = Sentinel::registerAndActivate([

                'email' => $request->get('email'),
                'password' => $request->get('password'),
                'token'=> str_random(30),
                'phone_number'=>'',


            ]);




            $role->users()->attach($user);
//TODO CHANGE RETURN TO REDIRECT ROUTE
            return view('welcome');
        }

    }

    public function signIn(Request $request)
    {

        $rememberMe = $request->get('remember');
        $remember = isset($rememberMe) && $rememberMe == 'on' ? true : false;

        if (!Sentinel::authenticate([
            'email' =>  $request->get('email'),
            'password' =>  $request->get('password'),
        ], $remember))
        {

            Session::flash('alert-danger', 'Email or Password Incorrect');
            return redirect()->action('WebController@index');

        } else {
            Session::flash('alert-success', 'Welcome Back');
            return redirect()->action('WebController@dashboard');
        }


    }

    public function signOut(Request $request)
    {


        Sentinel::logout();
        return redirect()->action('WebController@index');

    }

    public function dashboard(Request $request)
    {

        $users = User::where('phone_number', '!=', '')->get();

        return view('dashboard')
            ->with('users',$users);

    }


}

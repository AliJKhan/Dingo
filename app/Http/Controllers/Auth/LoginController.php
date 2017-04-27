<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\BaseController;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Illuminate\Support\Facades\Hash;
class LoginController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    public function signUp(Request $request)
    {
        $user = User::where('mobile',$request->get('mobile'))->first();

        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->permissions = json_encode(['user.delete' => 0 ]);


        if($user->save())
                return response()->json(['msg' => 'User Updated Successfully'], 200);
        else
              return response()->json(['msg' => 'Error Was Not Updated Successfully'], 500);
    }

    public function mobileSignUp(Request $request)
    {

        $role = Sentinel::findRoleByName('User');
        $user = new User();

        $user->mobile = $request->get('mobile');
        if(!$user->save())
        {
            return response()->json(['msg' => 'User Already Registered'], 200);
        }

        $role->users()->attach($user);

        $activation = Activation::create($user);
        Activation::complete($user, $activation->code);

        return response()->json(['msg' => 'User Created Successfully'], 200);
    }

    public function authenticate(Request $request)
    {
        // grab credentials from the request
        $credentials = $request->only('email','password');

        try {

            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        return response()->json(compact('token'));
    }

    public function getUser()
    {

        try{
            $user =  JWTAuth::parseToken()->toUser();

            if(!$user)
            {
                return $this->response->errorNotFound("User Not Found");
            }
        }
        catch(\Tymon\JWTAuth\Exceptions\JWTException $e)
        {
            $this->response->error("Something Went Wrong");
        }

        return $this->response->array(compact('user'))->setStatusCode(200);
    }

    public function refreshToken()
    {
        $token = JWTAuth::getToken();
        if(!$token)
        {
            return $this->response->errorUnauthorized("Token is invalid");
        }

        try{
            $refreshedToken = JWTAuth::refresh($token);
        }
        catch(JWTException $e)
        {
            $this->response->error("Something went wrong");
        }
        return $this->response->array(compact('refreshedToken'));

    }


}

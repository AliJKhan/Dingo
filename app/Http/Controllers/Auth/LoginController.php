<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\BaseController;
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

    public function show()
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

     public function getToken()
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

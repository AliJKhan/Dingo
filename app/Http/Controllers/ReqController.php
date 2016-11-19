<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Req;
use JWTAuth;

class ReqController extends Controller
{
	 public function index()
   {
   		 return Req::all();
   }

    public function create(Request $request)
   {
   		  $user =  JWTAuth::parseToken()->toUser();
   		    if(!$user)
            {
                return $this->response->errorNotFound("User Not Found");
            }   
		
           $req = new Req;
           $req->user_id = $user->id; 
           $req->title = $request->input('title');
           $req->description = $request->input('description');
           $req->status = 'Pending';
           $req->pickup = $request->input('pickup');
           $req->dropoff = $request->input('dropoff');
           $req->to = $request->input('to');
           $req->from = $request->input('from');

           if($req->save())
           {
           	return "New Request Created";
           }
   }
}

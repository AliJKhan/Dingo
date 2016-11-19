<?php

namespace App\Http\Controllers;
use \App\User;
use Illuminate\Http\Request;

class ApiController extends Controller
{
   public function index()
   {
		return User::all();
   }

   public function show($id)
   {
   	try{
		return User::find($id);
   	}
   	catch(Exception $ex)
   	{
   		return $ex;
   	}
   }

}

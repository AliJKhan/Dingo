<?php

namespace App\Http;


use App\Mail\OrderPlaced;
use Illuminate\Support\Facades\Mail;

class helpers
{


    public static function sendMail($userEmail,$order)
    {

        try{
           
            Mail::to($userEmail)->send(new OrderPlaced($order));

        }
        catch(Exception $ex)
        {
            return $ex;
        }
    }
}

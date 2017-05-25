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

    public static function sendSms($userPhone,$sms)
    {

        try{
            $type = "xml";
            $id = "autogenie";
            $pass = "qweQWE123!@#";
            $lang = "English";
            $mask = "AUTO GENIE";
            $to = $str = ltrim($userPhone, '+');

            $message = $sms;
            $message = urlencode($message);
            $data = "id=".$id."&pass=".$pass."&msg=".$message."&to=".$to."&lang=".$lang."&mask=".$mask."&type=".$type;

            $ch = curl_init('http://www.sms4connect.com/api/sendsms.php/sendsms/url');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch); //This is the result from SMS4CONNECT
            curl_close($ch);

        }
        catch(Exception $ex)
        {
            return $ex;
        }
    }
}

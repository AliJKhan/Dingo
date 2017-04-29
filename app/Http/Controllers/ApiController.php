<?php

namespace App\Http\Controllers;

use App\modelnyear;
use App\otp_verification,
    App\User,
    App\carModels,
    App\make,
    Cartalyst\Sentinel\Laravel\Facades\Sentinel;

use Illuminate\Http\Request;

class ApiController extends Controller
{


    public function postGenerateOtp(Request $request)
    {
        try{
            $type = "xml";
            $id = "autogenie";
            $pass = "qweQWE123!@#";
            $lang = "English";
            $mask = "AUTO GENIE";

            $otp = rand("1111", "9999");



            $mobile = $request->get('phone_number');

            $optRequest =  otp_verification::where('phone_number', $mobile)->first();

            if($optRequest){

                return response()->json(['response_code' => ConstantsController::OTP_EXISTS, 'message' => "Pin already generated, User not SignedUp", 'data' =>$optRequest->otp_pin], 200);

            }

            $optRequest = new otp_verification();
            $optRequest->otp_pin = $otp;
            $optRequest->phone_number = $mobile;
            $optRequest->save();
            $to = $str = ltrim($mobile, '+');

            $message = "Welcome to Auto Genie. Your code is: " .$otp;
            $message = urlencode($message);
            $data = "id=".$id."&pass=".$pass."&msg=".$message."&to=".$mobile."&lang=".$lang."&mask=".$mask."&type=".$type;

            $ch = curl_init('http://www.sms4connect.com/api/sendsms.php/sendsms/url');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch); //This is the result from SMS4CONNECT
            curl_close($ch);

            return response()->json(['response_code' => ConstantsController::OTP_SUCCESSFULLY_SENT, 'message' => "OTP Code Sent" , "data"=>''], 200);



        }
        catch(Exception $ex)
        {
            return $ex;
        }
    }

    public function postVerifyOtp(Request $request)
    {
        try{

            if($request->get('pin') && $request->get('phone_number')){
                $mobile = $request->get('phone_number');

                $pin = $request->get('pin');


                $otp = otp_verification::where('phone_number', $mobile)
                    ->where( 'otp_pin', $pin )
                    ->first();
                if($otp) {
                    $user = User::where('phone_number', $mobile)->first();

                    if($user){
                        return response()->json(['response_code' => ConstantsController::OTP_VERIFIED_USER_ALREADY_EXITS, 'message' => "Pin verified, User already SignedUp", 'data' =>$user->token], 200);
                    }
                    $role = Sentinel::findRoleByName('User');

                    $user = new User();

                    $user->phone_number = $request->get('phone_number');
                    $user->token    = str_random(30);
                    $user->save();
                    $role->users()->attach($user);
                    return response()->json( ['response_code' => ConstantsController::OTP_VERIFIED_NEW_USER_SIGNED_UP, 'message' => "Pin verified, New User SignedUp", 'data' =>$user->token], 200);


                }
                else{
                    return response()->json( ['response_code' => ConstantsController::OTP_NOT_VERIFIED, 'message' => "Pin not verified. ", 'data' => 0 ], 200);

                }



            } else {

                return response()->json([ 'response_code' =>ConstantsController::FAILURE , 'message' => "Number not found", 'data'=> ""], 200);

            }




        }
        catch(Exception $ex)
        {
            return $ex;
        }
    }

    public function getMakes(Request $request)
    {
        try{

            $makes= make::orderBy('name')->get();

            return response()->json(['response_code' => ConstantsController::SUCCESS, 'message' => "" , "data"=> $makes], 200);



        }
        catch(Exception $ex)
        {
            return $ex;
        }
    }

    public function getModel(Request $request)
    {
        try{

            $make=  make::find($request->get('make'));

            $models = $make->models;

            return response()->json(['response_code' => ConstantsController::SUCCESS, 'message' => "Model Found" , "data"=>$models], 200);

        }
        catch(Exception $ex)
        {
            return $ex;
        }
    }

    public function getModelNYear(Request $request)
    {
        try{

            $modelsNYear = \DB::table('modelnyear')
                ->join('years', function($join)use($request)
                {
                    $join->on('modelnyear.years_id', '=', 'years.id')
                        ->where('modelnyear.car_models_id',$request->get('model'));
                })
                ->get();
            return response()->json(['response_code' => ConstantsController::SUCCESS, 'message' => "Models Found" , "data"=>$modelsNYear], 200);

        }
        catch(Exception $ex)
        {
            return $ex;
        }
    }
}

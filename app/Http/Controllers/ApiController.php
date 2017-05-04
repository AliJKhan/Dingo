<?php

namespace App\Http\Controllers;
use Validator;;
use App\otp_verification,
    App\User,
    App\car_models,
    App\make,
    App\oil_filter_brands,
    App\air_filter_brands,
    App\modelnyear,
    Cartalyst\Sentinel\Laravel\Facades\Sentinel,
    App\owned_cars,
    App\service,
    App\oil_brands;

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

            $validator = Validator::make($request->all(), [
                'phone_number' =>  array('required', 'regex:/^[+]923\d{9}$/i')

            ]);

            if ($validator->fails())
            {
                return response()->json(['response_code' => ConstantsController::ERROR_IN_NUMBER, 'message' => "Number Format Incorrect" , "data"=>''], 200);

            }
            $mobile = $request->get('phone_number');



            $optRequest =  otp_verification::where('phone_number', $mobile)->first();

            if($optRequest){

                $to = $str = ltrim($mobile, '+');
                $optRequest->otp_pin = $otp;
                $optRequest->save();
                $message = "Welcome to Auto Genie. Your code is: " .$optRequest->otp_pin;
                $message = urlencode($message);
                $data = "id=".$id."&pass=".$pass."&msg=".$message."&to=".$to."&lang=".$lang."&mask=".$mask."&type=".$type;

                $ch = curl_init('http://www.sms4connect.com/api/sendsms.php/sendsms/url');
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $result = curl_exec($ch); //This is the result from SMS4CONNECT
                curl_close($ch);
                return response()->json(['response_code' => ConstantsController::OTP_SUCCESSFULLY_SENT, 'message' => "OTP Code Sent" , "data"=>''], 200);


            }

            $optRequest = new otp_verification();
            $optRequest->otp_pin = $otp;
            $optRequest->phone_number = $mobile;
            $optRequest->save();
            $to = $str = ltrim($mobile, '+');

            $message = "Welcome to Auto Genie. Your code is: " .$otp;
            $message = urlencode($message);
            $data = "id=".$id."&pass=".$pass."&msg=".$message."&to=".$to."&lang=".$lang."&mask=".$mask."&type=".$type;

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
                        return response()->json(['response_code' => ConstantsController::OTP_VERIFIED_USER_ALREADY_EXITS, 'message' => "Pin verified, User already SignedUp", 'data' =>['user_id'=>$user->id,'token'=>$user->token]], 200);
                    }
                    $role = Sentinel::findRoleByName('User');

                    $user = new User();

                    $user->phone_number = $request->get('phone_number');
                    $user->token    = str_random(30);
                    $user->save();
                    $role->users()->attach($user);
                    return response()->json( ['response_code' => ConstantsController::OTP_VERIFIED_NEW_USER_SIGNED_UP, 'message' => "Pin verified, New User SignedUp", 'data' =>['user_id'=>$user->id,'token'=>$user->token]], 200);


                }
                else{
                    return response()->json( ['response_code' => ConstantsController::OTP_NOT_VERIFIED, 'message' => "Pin not verified. ", 'data' =>['user_id'=>-1,'token'=>''] ], 200);

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

            $makes= make::all();

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

            $make=  make::find($request->get('make_id'));

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
                        ->where('modelnyear.car_models_id',$request->get('model_id'));
                })
                ->get();
            return response()->json(['response_code' => ConstantsController::SUCCESS, 'message' => "Models Found" , "data"=>$modelsNYear], 200);

        }
        catch(Exception $ex)
        {
            return $ex;
        }
    }

    public function getOilFilterBrands(Request $request)
    {
        try{

            $oilFilterBrands = oil_filter_brands::all();

            return response()->json(['response_code' => ConstantsController::SUCCESS, 'message' => "Oil Filter Brands" , "data"=>$oilFilterBrands], 200);

        }
        catch(Exception $ex)
        {
            return $ex;
        }
    }

    public function getOilFilterPrice(Request $request)
    {
        try{

            $oilFilterPrice = \DB::table('oil_filter_brands')
                ->join('oil_filter_price', function($join)use($request)
                {
                    $join->on('oil_filter_price.oil_filter_brands_id', '=', 'oil_filter_brands.id')
                        //  ->where('oil_filter_brands.id',$request->get('oil_filter_brands_id'))
                        ->where('oil_filter_price.modelnyear_id',$request->get('modelnyear_id'));
                })
                ->get();


            return response()->json(['response_code' => ConstantsController::SUCCESS, 'message' => "Oil Filter Price" , "data"=>$oilFilterPrice], 200);

        }
        catch(Exception $ex)
        {
            return $ex;
        }
    }

    public function getAirFilterBrands(Request $request)
    {
        try{

            $airFilterBrands = air_filter_brands::all();

            return response()->json(['response_code' => ConstantsController::SUCCESS, 'message' => "Air Filter Brands" , "data"=>$airFilterBrands], 200);

        }
        catch(Exception $ex)
        {
            return $ex;
        }
    }

    public function getAirFilterPrice(Request $request)
    {
        try{

            $airFilterPrice = \DB::table('air_filter_brands')
                ->join('air_filter_price', function($join)use($request)
                {
                    $join->on('air_filter_price.air_filter_brands_id', '=', 'air_filter_brands.id')
                        // ->where('air_filter_brands.id',$request->get('air_filter_brands_id'))
                        ->where('air_filter_price.modelnyear_id',$request->get('modelnyear_id'));
                })
                ->get();

            return response()->json(['response_code' => ConstantsController::SUCCESS, 'message' => "Air Filter Price" , "data"=>$airFilterPrice], 200);

        }
        catch(Exception $ex)
        {
            return $ex;
        }
    }



    public function getAllServices(Request $request)
    {
        try{

            $services = service::all();

            return response()->json(['response_code' => ConstantsController::SUCCESS, 'message' => "Services" , "data"=>$services], 200);

        }
        catch(Exception $ex)
        {
            return $ex;
        }
    }

    public function getOilChangePrices(Request $request)
    {
        try{

            $engineOilCapacity = modelnyear::find($request->get('modelnyear_id'))->getCapacity->capacity;
            $oilBrands = oil_brands::all();

            foreach ($oilBrands as $brand) {
                $brand->price = $engineOilCapacity * $brand->price;
            }
            return response()->json(['response_code' => ConstantsController::SUCCESS, 'message' => "Engine Oil Prices" , "data"=>$oilBrands], 200);

        }
        catch(Exception $ex)
        {
            return $ex;
        }
    }

    public function postOwnedCar(Request $request)
    {
        try{
            $user = User::where('token', $request->get('token'))->first();
            $ownedCar = new owned_cars();
            $ownedCar->fill($request->all());
            $ownedCar->primary_id = $request->get('primary_id');
            $ownedCar->user_id = $user->id;
            $ownedCar->save();
            return response()->json(['response_code' => ConstantsController::SUCCESS, 'message' => "Car Saved" , "data"=>$ownedCar->id], 200);

        }
        catch(Exception $ex)
        {
            return $ex;
        }
    }

    public function getOwnedCars(Request $request)
    {
        try{
            $user = User::where('token', $request->get('token'))->first();

            $ownedCars = $user->getAllCars;
            if(!$ownedCars->first()){
                return response()->json(['response_code' => ConstantsController::USER_EXISTS_NO_CARS_FOUND, 'message' => "No Cars Found" , "data"=>""], 200);
            }
            return response()->json(['response_code' => ConstantsController::SUCCESS, 'message' => "Cars Found" , "data"=>$ownedCars], 200);

        }
        catch(Exception $ex)
        {
            return $ex;
        }
    }

    public function updateOwnedCar(Request $request)
    {
        try{
            $ownedCar = owned_cars::find($request->get('id'))->first();
            $ownedCar->fill($request->all());
            $ownedCar->save();
            return response()->json(['response_code' => ConstantsController::SUCCESS, 'message' => "Cars Updated" , "data"=>""], 200);

        }
        catch(Exception $ex)
        {
            return $ex;
        }
    }

}

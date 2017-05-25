<?php

namespace App\Http\Controllers;
use App\address;
use App\Mail\OrderPlaced;
use App\modelnyear_battery;
use App\modelnyear_service;
use App\order_items;
use App\order_sub_items;
use App\orders;
use App\promo_codes;
use Illuminate\Support\Facades\Mail;
use Validator;
use App\Http\helpers;
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
                        $ownedCars = $user->getAllCars;
                        if(!$ownedCars->first()) {
                            return response()->json(['response_code' => ConstantsController::USER_EXISTS_NO_CARS_FOUND, 'message' => "No Cars Found" , "data"=> ['user_id' => $user->id, 'token' => $user->token]], 200);

                        }else{
                            return response()->json(['response_code' => ConstantsController::OTP_VERIFIED_USER_ALREADY_EXITS, 'message' => "Pin verified, User already SignedUp", 'data' => ['user_id' => $user->id, 'token' => $user->token]], 200);

                        }


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
                ->select('modelnyear.id as id','modelnyear.car_models_id as car_models_id','years.id as years_id','years.name as name')
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

    public function getOilFilterBrandsWithPrices(Request $request)

    {
        try{

            $oilFilterPrice = \DB::table('oil_filter_brands')
                ->join('oil_filter_price', function($join)use($request)
                {
                    $join->on('oil_filter_price.oil_filter_brands_id', '=', 'oil_filter_brands.id')
                        //  ->where('oil_filter_brands.id',$request->get('oil_filter_brands_id'))
                        ->where('oil_filter_price.modelnyear_id',$request->get('modelnyear_id'));
                })
                ->select('oil_filter_brands.name as name','oil_filter_brands.thumbnail as thumbnail','oil_filter_brands.id as id','oil_filter_price.price as price')
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

    public function getAirFilterBrandsWithPrices(Request $request)
    {
        try{

            $airFilterPrice = \DB::table('air_filter_brands')
                ->join('air_filter_price', function($join)use($request)
                {
                    $join->on('air_filter_price.air_filter_brands_id', '=', 'air_filter_brands.id')
                        // ->where('air_filter_brands.id',$request->get('air_filter_brands_id'))
                        ->where('air_filter_price.modelnyear_id',$request->get('modelnyear_id'));
                })
                ->select('air_filter_brands.name as name','air_filter_brands.thumbnail as thumbnail','air_filter_brands.id as id','air_filter_price.price as price')
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

            $services = \DB::table('service')
                ->join('modelnyear_service', function($join)use($request)
                {
                    $join->on('modelnyear_service.service_id', '=', 'service.id')
                        ->where('modelnyear_service.modelnyear_id' ,$request->get('modelnyear_id'));
                })
                ->select('service.id as id','service.name as name','modelnyear_service.price as price','service.classification as classification','service.type_id as type','service.description as description','service.thumbnail as thumbnail','service.duration as duration')
                ->get();

            return response()->json(['response_code' => ConstantsController::SUCCESS, 'message' => "Services" , "data"=>$services], 200);

        }
        catch(Exception $ex)
        {
            return $ex;
        }
    }

    public function getOilBrandsWithPrices($modelnyear_id)
    {

        try{

            $engineOilCapacity = modelnyear::find($modelnyear_id)->getCapacity->capacity;
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
            if($request->id==0){
                return response()->json(['response_code' => ConstantsController::FAILURE, 'message' => "Car ID is 0" , "data"=>""], 200);

            }


            $ownedCar = owned_cars::find($request->id)->first();
            $ownedCar->fill($request->all());
            $ownedCar->save();
            return response()->json(['response_code' => ConstantsController::SUCCESS, 'message' => "Cars Updated" , "data"=>""], 200);

        }
        catch(Exception $ex)
        {
            return $ex;
        }
    }

    public function postOrder(Request $request)
    {


        try{


            $user = User::where('token', $request->token)->first();
            $user = Sentinel::findUserById($user->id);

            $order = new orders();
            $order->user_id = $user->id;
            $order->order_status_id = 1;
            $order->primary_id =  $request->primary_id;
            $order->original_price = $request->original_price;
            $order->discount_amount = $request->discount_amount;
            $order->after_discount_price = $request->after_discount_price;
            $order->address_id = $request->address['id'];
            $order->mechanic_id = $request->mechanic['id'];
            $order->order_status_id = $request->order_status['id'];
            $order->owned_car_id = $request->owned_car['id'];
            $order->promo_code_id = $request->promo_code['id'];
            $order->save();

            foreach ($request->order_items as $array){

                $orderItem = new order_items();
                $orderItem->orders_id = $order->id;
                $orderItem->primary_id = $array['primary_id'];
                $orderItem->order_primary_id = $array['order_primary_id'];
                $orderItem->service_id = $array['service']['id'];
                $orderItem->original_price = $array['original_price'];
                $orderItem->after_discount_price = $array['after_discount_price'];
                $orderItem->discount_amount = $array['discount_amount'];


                $orderItem->save();

                foreach ($array['service_sub_items'] as $sub_array){
                    $sub_array_item = new order_sub_items();
                    $sub_array_item->order_items_id = $orderItem->id;
                    $sub_array_item->brand_id = $sub_array['brand_id'];
                    $sub_array_item->primary_id = $sub_array['primary_id'];
                    $sub_array_item->order_item_primary_id = $sub_array['order_item_primary_id'];
                    $sub_array_item->original_price = $sub_array['original_price'];
                    $sub_array_item->discount_amount = $sub_array['discount_amount'];
                    $sub_array_item->after_discount_price = $sub_array['after_discount_price'];
                    $sub_array_item->brand_name = $sub_array['brand_name'];
                    $sub_array_item->brand_thumbnail = $sub_array['brand_thumbnail'];
                    $sub_array_item->save();


                }

            }


            $role = Sentinel::findRoleByName('User');

            if($order && $role->hasAccess('orderGenerated.email') &&  $user->hasAccess('orderGenerated.email')){

                helpers::sendMail($user->email,$order);

            }
            if($order && $role->hasAccess('orderGenerated.sms') &&  $user->hasAccess('orderGenerated.sms')){

              $sms = "Order Placed Successfully";
                helpers::sendSms($user->phone_number,$sms);
            }


            return response()->json(['response_code' => ConstantsController::SUCCESS, 'message' => "New Order Added" , "data"=>""], 200);

        }
        catch(Exception $ex)
        {
            return $ex;
        }
    }

    public function getOrder(Request $request)
    {
        try{

            $order = orders::find($request->order_id);
            $orderItems = $order->getItems;

            return response()->json(['response_code' => ConstantsController::SUCCESS, 'message' => "Order Found" , "data"=>$orderItems], 200);

        }
        catch(Exception $ex)
        {
            return $ex;
        }
    }

    public function getBatteryBrandsWithPrices($modelnyear_id)
    {
        $modelnyear = modelnyear_battery::where('modelnyear_id',$modelnyear_id)->first();
        try{

            $batteryBrandPrice = \DB::table('battery_brand')
                ->join('battery_amps', function($join)use($modelnyear)
                {
                    $join->on('battery_amps.battery_brand_id', '=', 'battery_brand.id')
                        // ->where('air_filter_brands.id',$request->get('air_filter_brands_id'))
                        ->where('battery_amps.amps',$modelnyear->amps);
                })
                ->get();

            return response()->json(['response_code' => ConstantsController::SUCCESS, 'message' => "Battery Brands with Prices" , "data"=>$batteryBrandPrice], 200);

        }
        catch(Exception $ex)
        {
            return $ex;
        }
    }

    public function getAllBrands(Request $request)
    {

        try{

            $service = service::find($request->id);
            $type = $service->type_id;

            switch ($type) {
                case 1:

                    return  $this->getOilBrandsWithPrices($request->modelnyear_id);

                    break;
                case 2:

                    return  $this->getBatteryBrandsWithPrices($request->modelnyear_id);
                    break;

                    break;
                default:
            }


        }
        catch(Exception $ex)
        {
            return $ex;
        }
    }

    public function checkPromoCode(Request $request)
    {

        try{
            $promoCode = promo_codes::where('code',$request->code)->first();

            if($promoCode)

                return response()->json(['response_code' => ConstantsController::SUCCESS, 'message' => "Code Found" , "data"=>$promoCode->discount_amount], 200);
            else{
                return response()->json(['response_code' => ConstantsController::FAILURE, 'message' => "Code Not Found" , "data"=>""], 200);

            }

        }
        catch(Exception $ex)
        {
            return $ex;
        }
    }

    public function postAddress(Request $request)
    {

        try{
            $user = User::where('token', $request->token)->first();
            $address = new address();
            $address->user_id = $user->id;
            $address->address = 'asd';
            $address->save();

            return response()->json(['response_code' => ConstantsController::SUCCESS, 'message' => "Address Saved" , "data"=>""], 200);



        }
        catch(Exception $ex)
        {
            return $ex;
        }
    }


    public function getAddress(Request $request)
    {

        try{
            $user = User::where('token', $request->token)->first();
            $addresses = $user->getAddresses;

            return response()->json(['response_code' => ConstantsController::SUCCESS, 'message' => "Address Found" , "data"=>$addresses], 200);



        }
        catch(Exception $ex)
        {
            return $ex;
        }
    }



}

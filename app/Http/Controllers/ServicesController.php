<?php

namespace App\Http\Controllers;

use App\air_filter_brands;
use App\air_filter_price;
use App\battery_amps;
use App\battery_brand;
use App\brake_pad_brand;
use App\brake_pad_price;
use App\car_models;
use App\mechanic;
use App\modelnyear;
use App\oil_filter_brands;
use App\oil_filter_price;
use App\service;
use App\years;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function index(Request $request)
    {
        $services = service::all();
        $batteryBrands = \DB::table('battery_brand')
            ->join('battery_amps', function($join)
            {
                $join->on('battery_brand.id', '=', 'battery_amps.battery_brand_id');
            })
            ->get();

        $airFilters = \DB::table('air_filter_brands')
            ->join('air_filter_price', function($join)use($request)
            {
                $join->on('air_filter_price.air_filter_brands_id', '=', 'air_filter_brands.id');
            })
            ->get();

        $oilFilters = \DB::table('oil_filter_brands')
            ->join('oil_filter_price', function($join)use($request)
            {
                $join->on('oil_filter_price.oil_filter_brands_id', '=', 'oil_filter_brands.id');
            })
            ->get();

        $brakePadBrands = \DB::table('brake_pad_brand')
            ->join('brake_pad_price', function($join)use($request)
            {
                $join->on('brake_pad_price.brake_pad_brand_id', '=', 'brake_pad_brand.id');
            })
            ->get();

        return view('services.index')
            ->with('services',$services)
            ->with('batteryBrands',$batteryBrands)
            ->with('airFilters',$airFilters)
            ->with('oilFilters',$oilFilters)
            ->with('brakePadBrands',$brakePadBrands);

    }

    public function editService(Request $request)
    {

        $type = $request->type;
        switch ($type) {
            case 1:
                $object = service::find($request->id);
                break;
            case 2:
                $object =  $batteryBrands = \DB::table('battery_brand')
                    ->join('battery_amps', function($join)use($request)
                    {
                        $join->on('battery_brand.id', '=', 'battery_amps.battery_brand_id')
                            ->where('battery_amps.id',$request->id);
                    })
                    ->first();
                break;
            case 3:
                $object = \DB::table('air_filter_brands')
                    ->join('air_filter_price', function($join)use($request)
                    {
                        $join->on('air_filter_price.air_filter_brands_id', '=', 'air_filter_brands.id')
                            ->where('air_filter_price.id',$request->id);
                    })
                    ->first();
                break;
            case 4:
                $object = \DB::table('oil_filter_brands')
                    ->join('oil_filter_price', function($join)use($request)
                    {
                        $join->on('oil_filter_price.oil_filter_brands_id', '=', 'oil_filter_brands.id')
                            ->where('oil_filter_price.id',$request->id);
                    })
                    ->first();
                break;
            case 5:
                $object = \DB::table('brake_pad_brand')
                    ->join('brake_pad_price', function($join)use($request)
                    {
                        $join->on('brake_pad_price.brake_pad_brand_id', '=', 'brake_pad_brand.id')
                            ->where('brake_pad_price.id',$request->id);
                    })
                    ->first();
            default:

        }

        return view('services.edit')
            ->with('object',$object)
            ->with('type',$type);


    }

    public function updateService(Request $request)
    {
        $type = $request->type;
        switch ($type) {
            case 1:
                $object = service::find($request->id);
                $object->name=$request->name;
                $object->price=$request->price;
                $object->save();

                break;
            case 2:
                \DB::table('battery_brand')
                    ->join('battery_amps', function($join)use($request)
                    {
                        $join->on('battery_brand.id', '=', 'battery_amps.battery_brand_id')
                            ->where('battery_amps.id',$request->id);

                    })
                    ->update(['battery_brand.name' => $request->name,'battery_amps.price'=>$request->price]);


                break;
            case 3:
                \DB::table('air_filter_brands')
                    ->join('air_filter_price', function($join)use($request)
                    {
                        $join->on('air_filter_price.air_filter_brands_id', '=', 'air_filter_brands.id')
                            ->where('air_filter_price.id',$request->id);
                    })
                    ->update(['air_filter_brands.name' => $request->name,'air_filter_price.price'=>$request->price]);
                break;
            case 4:
                \DB::table('oil_filter_brands')
                    ->join('oil_filter_price', function($join)use($request)
                    {
                        $join->on('oil_filter_price.oil_filter_brands_id', '=', 'oil_filter_brands.id')
                            ->where('oil_filter_price.id',$request->id);
                    })
                    ->update(['oil_filter_brands.name' => $request->name,'oil_filter_price.price'=>$request->price]);
                break;
            case 5:
                \DB::table('brake_pad_brand')
                    ->join('brake_pad_price', function($join)use($request)
                    {
                        $join->on('brake_pad_price.brake_pad_brand_id', '=', 'brake_pad_brand.id')
                            ->where('brake_pad_price.id',$request->id);
                    })
                    ->update(['brake_pad_brand.name' => $request->name,'brake_pad_price.price'=>$request->price]);
            default:
        }



        return redirect()->action('ServicesController@index');

    }

    public function addService(Request $request)
    {
        $models = car_models::all();

        return view('services.add')
            ->with('models',$models);

    }

    public function newService(Request $request)
    {

        $type = $request->selection;
        switch ($type) {
            case 1:
                $service = new service();
                $service->name = $request->name;
                $service->price = $request->price;
                $service->save();

                break;
            case 2:

                $battery = new battery_brand();
                $battery->name = $request->name;
                $battery->save();

                $batteryPrice = new battery_amps();
                $batteryPrice->battery_brand_id = $battery->id;
                $batteryPrice->amps = $request->amps;
                $batteryPrice->price = $request->price;
                $batteryPrice->save();

                break;
            case 3:
                $airFilter = new air_filter_brands();
                $airFilter->name = $request->name;
                $airFilter->save();

                $filterPrice = new air_filter_price();
                $filterPrice->air_filter_brands_id = $airFilter->id;
                $filterPrice->modelnyear_id = $request->modelnyear;
                $filterPrice->price = $request->price;
                $filterPrice->save();

                break;
            case 4:
                $oilFilter = new oil_filter_brands();
                $oilFilter->name = $request->name;
                $oilFilter->save();

                $filterPrice = new oil_filter_price();
                $filterPrice->oil_filter_brands_id = $oilFilter->id;
                $filterPrice->modelnyear_id = $request->modelnyear;
                $filterPrice->price = $request->price;
                $filterPrice->save();
                break;
            case 5:
                $breakPad = new brake_pad_brand();
                $breakPad->name = $request->name;
                $breakPad->save();

                $breakPadPrice = new brake_pad_price();
                $breakPadPrice->brake_pad_brand_id = $breakPad->id;
                $breakPadPrice->modelnyear_id = $request->modelnyear;
                $breakPadPrice->price = $request->price;
                $breakPadPrice->save();
            default:
        }

        return redirect()->action('ServicesController@index');

    }

    public function getModelnyear(Request $request)
    {

        $modelsNYear = \DB::table('modelnyear')
            ->join('years', function($join)use($request)
            {
                $join->on('modelnyear.years_id', '=', 'years.id')
                    ->where('modelnyear.car_models_id',$request->get('model_id'));
            })
            ->select('modelnyear.id as id','years.name as name')
            ->get();

        return response()->json(['response_code' => ConstantsController::SUCCESS, 'message' => "Models Found" , "data"=>$modelsNYear], 200);


    }


    //TODO DELETE SERVICE
    public function deleteService(Request $request)
    {
        Session::flash('alert-warning', 'Deleted');
        return redirect()->action('ServicesController@index');

    }

    public function mechanicsIndex(Request $request)
    {

        $mechanics = mechanic::all();
        return view('mechanics.index')
            ->with('mechanics',$mechanics);

    }

    public function addMechanic(Request $request)
    {


        return view('mechanics.add');

    }

    public function newMechanic(Request $request)
    {

        $mechanic = new mechanic();
        $mechanic->name = $request->name;
        $mechanic->phone_number = $request->phone_number;
        $mechanic->save();

        return redirect()->action('ServicesController@mechanicsIndex');

    }
}

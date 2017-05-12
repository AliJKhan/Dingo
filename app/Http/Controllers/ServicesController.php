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
use App\modelnyear_battery;
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
        return view('services.index')
            ->with('services',$services);
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
        $amps = battery_amps::all();
        $batteries = battery_brand::all();

        return view('services.add')
            ->with('models',$models)
            ->with('amps',$amps)
            ->with('batteries',$batteries);

    }

    public function newService(Request $request)
    {
      
        $yearFrom = $request->get('yearFrom');
        $yearTo = $request->get('yearTo');
        $yearCount = $yearFrom+0;

        if($yearFrom+0>$yearTo+0){
            Session::flash('alert-danger', 'Year from cannot be greater than to');
            return redirect()->action('ServicesController@addService');
        }




        $type = $request->selection;
        switch ($type) {
            case 1:
                $service = new service();
                $service->name = $request->objectName;
                $service->price = $request->price;
                $service->save();

                break;
            case 2:

                $battery = new battery_brand();
                $battery->name = $request->objectName;
                $battery->save();





                break;
            case 3:
                $airFilter = new air_filter_brands();
                $airFilter->name = $request->objectName;
                $airFilter->save();

                for($yearCount;$yearCount<=$yearTo;$yearCount++) {
                    $filterPrice = new air_filter_price();
                    $filterPrice->air_filter_brands_id = $airFilter->id;
                    $filterPrice->modelnyear_id = $yearCount;
                    $filterPrice->price = $request->price;
                    $filterPrice->save();
                }

                break;
            case 4:
                $oilFilter = new oil_filter_brands();
                $oilFilter->name = $request->objectName;
                $oilFilter->save();

                for($yearCount;$yearCount<=$yearTo;$yearCount++) {
                    $filterPrice = new oil_filter_price();
                    $filterPrice->oil_filter_brands_id = $oilFilter->id;
                    $filterPrice->modelnyear_id = $yearCount;
                    $filterPrice->price = $request->price;
                    $filterPrice->save();
                }
                break;
            case 5:
                $breakPad = new brake_pad_brand();
                $breakPad->name = $request->objectName;
                $breakPad->save();

                for($yearCount;$yearCount<=$yearTo;$yearCount++) {
                    $breakPadPrice = new brake_pad_price();
                    $breakPadPrice->brake_pad_brand_id = $breakPad->id;
                    $breakPadPrice->modelnyear_id = $yearCount;
                    $breakPadPrice->price = $request->price;
                    $breakPadPrice->save();
                }
            case 6:


                for($yearCount;$yearCount<=$yearTo;$yearCount++) {
                    $modelnyearBattery = new modelnyear_battery();

                    $modelnyearBattery->modelnyear_id = $yearCount;
                    $modelnyearBattery->amps = $request->ampsSelect;
                    $modelnyearBattery->save();
                }
            case 7:


                $batteryPrice = new battery_amps();
                $batteryPrice->battery_brand_id = $request->battery;
                $batteryPrice->amps = $request->amps;
                $batteryPrice->price = $request->price;
                $batteryPrice->save();
            default:
        }

        // return redirect()->action('ServicesController@index');
        Session::flash('alert-success', 'Object Added');
        return redirect()->action('ServicesController@addService');

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

    public function mechanics(Request $request)
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

        return redirect()->action('ServicesController@mechanics');

    }

    public function airFilters(Request $request)
    {

        $airFilters = \DB::table('air_filter_brands')->distinct()
            ->join('air_filter_price', function($join)use($request)
            {
                $join->on('air_filter_price.air_filter_brands_id', '=', 'air_filter_brands.id');
            })
            ->paginate(25);

        return view('services.airfilters')
            ->with('airFilters',$airFilters);

    }

    public function batteries(Request $request)
    {

        $batteryBrands = \DB::table('battery_brand')
            ->join('battery_amps', function($join)
            {
                $join->on('battery_brand.id', '=', 'battery_amps.battery_brand_id');
            })
            ->paginate(25);

        return view('services.batteries')
            ->with('batteryBrands',$batteryBrands);

    }

    public function oilFilters(Request $request)
    {


        $oilFilters = \DB::table('oil_filter_brands')
            ->join('oil_filter_price', function($join)use($request)
            {
                $join->on('oil_filter_price.oil_filter_brands_id', '=', 'oil_filter_brands.id');
            })
            ->paginate(25);

        return view('services.oilFilters')
            ->with('oilFilters',$oilFilters);

    }

    public function breakPads(Request $request)
    {


        $brakePadBrands = \DB::table('brake_pad_brand')
            ->join('brake_pad_price', function($join)use($request)
            {
                $join->on('brake_pad_price.brake_pad_brand_id', '=', 'brake_pad_brand.id');
            })
            ->paginate(25);

        return view('services.brakePads')
            ->with('brakePadBrands',$brakePadBrands);

    }

    public function addModelnyear(Request $request)
    {


        $carModels = car_models::all();
        $years  = years::all();


        return view('services.modelnyear')
            ->with('carModels',$carModels)
            ->with('years',$years);

    }

    public function newModelnyear(Request $request)
    {


        $yearFrom = $request->get('yearFrom');
        $yearTo = $request->get('yearTo');
        $yearCount = $yearFrom+0;

        if($yearFrom+0>$yearTo+0){
            Session::flash('alert-danger', 'Year from cannot be greater than To');
            return redirect()->action('ServicesController@addModelnyear');
        }


        for($yearCount;$yearCount<=$yearTo;$yearCount++) {
           $modelnyear = new modelnyear();
           $modelnyear->car_models_id = $request->car_models;
           $modelnyear->years_id = $yearCount;
           $modelnyear->save();
        }

        Session::flash('alert-success', 'Object Added');
        return redirect()->action('ServicesController@addModelnyear');

    }



}


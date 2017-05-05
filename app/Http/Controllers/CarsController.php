<?php

namespace App\Http\Controllers;

use App\owned_cars;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    public function viewCar(Request $request)
    {
        $ownedCar = owned_cars::find($request->get('id'))->first();

        return view('car.view')
            ->with('ownedCar',$ownedCar);

    }

    public function editCar(Request $request)
    {


        $ownedCar = owned_cars::find($request->get('id'))->first();

        return view('car.edit')
            ->with('ownedCar',$ownedCar);

    }

    public function updateCar(Request $request)
    {

        $ownedCar = owned_cars::find($request->get('id'));
        $ownedCar->fill($request->all());
        $ownedCar->save();

        return view('car.view')
            ->with('ownedCar',$ownedCar);

    }
}

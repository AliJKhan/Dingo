<?php

namespace App\Http\Controllers;

use App\owned_cars;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    public function viewCar(Request $request)
    {
        $ownedCar = owned_cars::find($request->get('id'));

        return view('cars.view')
            ->with('ownedCar',$ownedCar);

    }

    public function editCar(Request $request)
    {


        $ownedCar = owned_cars::find($request->get('id'));

        return view('cars.edit')
            ->with('ownedCar',$ownedCar);

    }

    public function updateCar(Request $request)
    {

        $ownedCar = owned_cars::find($request->get('id'));
        $ownedCar->fill($request->all());
        $ownedCar->save();


        return view('cars.view')
            ->with('ownedCar',$ownedCar);

    }
}

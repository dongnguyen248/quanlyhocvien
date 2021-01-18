<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use DateTime;

class CarsController extends Controller
{
    //
    public function index(Request $request){
        $cars =Car::all();
        if ( $request->input('client') ) {
    	    return Car::select('namecar','Center','LevelCar','startdate','endDate','dateremain','status','baohiem','note')->get();
    	}

        $columns = ['namecar','Center','LevelCar','startdate','endDate','dateremain','status','baohiem','note'];

        $length = $request->input('length');
        // dd($length);
        $column = $request->input('column'); //Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = Car::select('id','namecar','Center','LevelCar','startdate','endDate','baohiem','note')->where('status','=',1)->orderBy($columns[$column], $dir);

        if ($searchValue) {
            $query->where(function($query) use ($searchValue) {
                $query->where('namecar', 'like', '%' . $searchValue . '%')
                ->orWhere('Center', 'like', '%' . $searchValue . '%');
            });
        }

        $data = $query->paginate($length);
        return response()->json(['cars'=>$cars,'data' => $data, 'draw' => $request->input('draw')]);
    }
    public function new(Request $request){
        $car = Car::create([
            'namecar'=>$request['namecar'],
            'Center'=>$request['center'],
            'LevelCar'=>$request['levelcar'],
            'startdate'=>$request['starttime'],
            'endDate'=>$request['endtime'],
            'baohiem'=>$request['baohiem'],
            'note'=>$request['note'],
           
        ]);
    }
    public function get($id)
    {

        $car = Car::find($id);
        return response()->json([
            'car' => $car
        ], 200);
    }
    public function editCar(Request $request,$id){
            $car = Car::findOrFail($id);
            $car->namecar= $request['namecar'];
            $car->Center= $request['center'];
            $car->LevelCar= $request['levelcar'];
            $car->startdate= $request['starttime'];
            $car->endDate= $request['endtime'];
            $car->baohiem= $request['baohiem'];
            $car->note= $request['note'];
            $car->save();
            return response()->json(['msg'=>'update successfull']);
    }
    public function delete($id){
        $car = Car::findOrFail($id);
        $car->status='0';
        $car->save();
        return response()->json(['msg'=>'delete succes']);
    }
}

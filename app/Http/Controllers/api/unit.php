<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\unit\delete;
use App\Http\Requests\api\unit\update;
use App\Http\Requests\Unit\store;
use Illuminate\Http\Request;
use App\repo\interfaces\unitinterface;
class unit extends Controller
{

    public $unit;

    public function __construct(unitinterface $unit)
    {
        $this->unit = $unit;
    }

    public function store(store $request){


        try{

            $unit=$this->unit->store($request->name, $request->modifier);
            return response()->json($unit, 200);

        }catch(\Exception $ex){

            return response()->json(["message" => "we Have Error"], 500);
        }


    }



    public function update(update $request){

        try{


            $unit=$this->unit->update($request->id, $request->name, $request->modifier);
            return response()->json($unit, 200);

        }catch(\Exception $ex){


            return response()->json(["message" => "We Have Error"], 500);

        }


    }


    public function getAllUnit(Request $request){

        try{

            return $this->unit->getAllUnit();

        }catch(\Exception $ex){


            return response()->json(["message" => "We Have Error"], 500);


        }


    }



    public function delete(delete $request){
        try{


            $this->unit->delete($request->id);


        }catch(\Exception $ex){



            return response()->json(["message" => "We Have Error"], 500);
        }



    }
}

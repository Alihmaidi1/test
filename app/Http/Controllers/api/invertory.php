<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\invertory\delete;
use App\Http\Requests\invertory\store;
use Illuminate\Http\Request;
use App\repo\interfaces\invertoryinterface;

class invertory extends Controller
{


    public $invertory;

    public function __construct(invertoryinterface $invertory)
    {
        $this->invertory = $invertory;
    }

    public function store(store $request){

        try{

            $invertory=$this->invertory->store($request->product_id, $request->unit_id, $request->amount);

            return response()->json($invertory, 200);

        }catch(\Exception $ex){


            return response()->json(["message" => "We Have Error"], 500);


        }



    }


    public function delete(delete $request){

        try{


            $this->invertory->delete($request->id);

        }catch(\Exception $ex){


            return response()->json(["message"=>"We Have Error"],500);
        }


    }


}

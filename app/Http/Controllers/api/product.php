<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\product\delete;
use App\Http\Requests\api\product\update;
use App\Http\Requests\Product\store;
use Illuminate\Http\Request;
use App\repo\interfaces\productinterface;
class product extends Controller
{


    public $product;
    public function __construct(productinterface $product)
    {

        $this->product = $product;
    }

    public function store(store $request){

        try{

            $product=$this->product->store($request->name);
            return response()->json($product, 200);

        }catch(\Exception $ex){


            return response()->json(["message"=>"We Have Error"], 500);


        }

    }


    public function update(update $request){

        try{


            $product=$this->product->update($request->id, $request->name);
            return response()->json($product, 200);


        }catch(\Exception $ex){


            return response()->json(["message"=>"We Have Error"], 500);


        }


    }


    public function getAllProduct(Request $request){


        try{

            $products=$this->product->getAllProduct();

            return response()->json($products, 200);

        }catch(\Exception $ex){

            return response()->json(["message"=>"We Have Error"], 500);

        }



    }



    public function delete(delete $request){

        try{

            $this->product->delete($request->id);

        }catch(\Exception $ex){

            return response()->json(["message"=>"We Have Error"], 500);

        }



    }


}

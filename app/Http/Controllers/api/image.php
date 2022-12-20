<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\image\delete;
use App\Http\Requests\image\store;
use Illuminate\Http\Request;
use App\repo\interfaces\imageinterface;
class image extends Controller
{


    public $image;
    public function __construct(imageinterface $image)
    {

        $this->image = $image;
    }

    public function store(store $request){

        try{
        $path=saveImage($request->path, $request->imageable_type);
        $image=$this->image->store($request->imageable_id, $request->imageable_type, $path, $request->description);
        return response()->json($image, 200);
        }catch(\Exception $ex){

            return response()->json(["message" => "We Have Error"],500);
        }

    }



    public function delete(delete $request){

        try{

            $this->image->delete($request->id);

        }catch(\Exception $ex){


            return response()->json(["message" => $ex->getMessage()],500);


        }


    }
}

<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\api\user\login as loginRequest;
class user extends Controller
{


    public function login(loginRequest $request){

    if($token=auth("api")->attempt($request->all())){

            $user=auth("api")->user();
            $user->token=$token;
            return response()->json($user, 200);

    }else{

        return response()->json(["message"=>"The Email Or Password is not correct"], 500);

    }

    }


    public function logout(Request $request){

        try{

            auth("api")->logout();

        }catch(\Exception $ex){

            return response()->json(["message"=>"We Have Error"],500);
        }



    }

}

<?php

namespace App\repo\classes;

use App\Models\User as ModelsUser;
use App\repo\interfaces\userinterface;


class user implements userinterface{


    public function store($name,$email,$password){

        return ModelsUser::create([
            "name"=>$name,
            "email"=>$email,
            "password"=>$password
        ]);

    }



}

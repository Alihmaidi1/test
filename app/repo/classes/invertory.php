<?php

namespace App\repo\classes;

use App\Models\product_unit;
use App\repo\interfaces\invertoryinterface;



class invertory implements invertoryinterface{

    public function store($product_id, $unit_id, $amount){


        return product_unit::create([

            "product_id"=>$product_id,
            "unit_id"=>$unit_id,
            "amount"=>$amount
        ]);


    }


    public function delete($id)
    {

        return product_unit::findOrFail($id)->delete();

    }

}

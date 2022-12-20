<?php

namespace App\repo\classes;

use App\Models\Unit as ModelsUnit;
use App\repo\interfaces\unitinterface;
use Illuminate\Support\Facades\Cache;

class unit implements unitinterface{

    public function store($name,$modifier){


        $unit=ModelsUnit::create([

            "name"=>$name,
            "modifier"=>$modifier

        ]);

        Cache::put("unit:".$unit->id, $unit);
        Cache::put("units", ModelsUnit::get());
        return $unit;
    }


    public function update($id, $name, $modifier){

        $unit = Cache::get("unit:" . $id);
        $unit->name = $name;
        $unit->modifier = $modifier;
        $unit->save();
        Cache::put("unit:" . $id, $unit);
        Cache::put("units", ModelsUnit::get());
        return $unit;
    }

    public function getAllUnit(){


        return Cache::get("units");
    }


    public function delete($id){

        ModelsUnit::findOrFail($id)->delete();
        Cache::pull("unit:" . $id);
        Cache::put("units", ModelsUnit::get());

    }


}

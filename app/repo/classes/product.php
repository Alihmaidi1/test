<?php


namespace App\repo\classes;
use App\Models\Product as ModelsProduct;
use App\repo\interfaces\productinterface;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class product implements productinterface{


    public function store($name){


        $product=ModelsProduct::create([

            "name"=>$name

        ]);

        Cache::put("product:".$product->id, $product);// cache with redis
        Cache::put("products", ModelsProduct::get());
        return $product;
    }

    public function getSumByUnit($unit_id,$product_id){

        $result = DB::select("SELECT SUM(product_units.amount*units.modifier)as total FROM product_units
                    inner join units ON product_units.unit_id=units.id WHERE units.id=? AND product_units.product_id=?",[$unit_id,$product_id]);
        $sum = ($result[0])?$result[0]->total:0;
        return $sum;
    }



    public function update($id, $name){

        $product = $this->find($id);
        $product->name=$name;
        $product->save();
        Cache::put("product:" . $product, $product);
        Cache::put("products", ModelsProduct::get());
        return $product;
    }


    public function find($id){


        return Cache::get("product:" . $id);


    }


    public function getAllProduct(){


        return Cache::get("products");
    }

    public function delete($id){
        $product=ModelsProduct::findOrFail($id);
        $product->delete();
        Cache::pull("product:" . $id);
        Cache::put("products", ModelsProduct::get());

    }


}

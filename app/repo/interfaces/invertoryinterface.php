<?php
namespace App\repo\interfaces;


interface invertoryinterface{


    public function store($product_id, $unit_id, $amount);

    public function delete($id);


}

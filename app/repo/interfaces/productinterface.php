<?php

namespace App\repo\interfaces;


interface productinterface{


    public function store($name);
    public function getSumByUnit($unit_id,$product_id);

    public function update($id, $name);

    public function find($id);

    public function getAllProduct();


    public function delete($id);

}

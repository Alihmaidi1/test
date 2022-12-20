<?php

namespace App\repo\interfaces;

interface unitinterface{


    public function store($name,$modifier);

    public function update($id, $name, $modifier);

    public function getAllUnit();

    public function delete($id);
}

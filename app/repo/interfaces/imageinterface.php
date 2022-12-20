<?php

namespace App\repo\interfaces;


interface imageinterface{


    public function store($imageable_id, $imageable_type, $path, $description);
    public function delete($id);

}

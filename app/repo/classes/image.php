<?php

namespace App\repo\classes;

use App\Models\Image as ModelsImage;
use App\repo\interfaces\imageinterface;
use Illuminate\Support\Facades\Storage;

class image implements imageinterface{


    public function store($imageable_id, $imageable_type, $path, $description){

        return ModelsImage::create([

            "imageable_id"=>$imageable_id,
            "imageable_type"=>$imageable_type,
            "path"=>$path,
            "description"=>$description

        ]);

    }


    public function delete($id){

        $image = ModelsImage::findOrFail($id);
        Storage::disk("s3")->delete($image->getRawOriginal("path"));
        $image->delete();


    }

}

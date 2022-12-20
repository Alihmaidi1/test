<?php

use Illuminate\Support\Facades\Storage;

function saveImage($file,$folder){

    $logo=time().rand(0,9999999).".".$file->getClientOriginalExtension();
    // $path=Storage::disk("s3")->putFileAs($folder,$file,$logo);
    $path=Storage::disk("public")->putFileAs($folder,$file,$logo);

    return $path;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'path',
        'description',
        "imageable_id",
        "imageable_type",

    ];

    // public function getPathAttribute($value){

    //     return Storage::disk("s3")->url($value);
    // }
    protected $hidden = ["created_at","updated_at"];

    public function imageable()
    {
        return $this->morphTo();

    }



    public function setImageableTypeAttribute($value){

        $this->attributes["imageable_type"]="App\Models\\".$value;

    }

}

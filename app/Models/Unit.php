<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\product_unit;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Unit extends Model
{
    use HasFactory;
    use HasUuids;
    protected $fillable = [
        'name',
        'modifier',
    ];


    protected $hidden=["created_at","updated_at"];

    public function products(){

        return $this->belongsToMany(Product::class,product_unit::class,"product_id","unit_id");

    }



}

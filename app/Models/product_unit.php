<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_unit extends Model
{
    use HasFactory;
    use HasUuids;
    public $fillable = ["product_id","unit_id","amount"];
    protected $hidden=["created_at","updated_at"];

}

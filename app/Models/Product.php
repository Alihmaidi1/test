<?php

namespace App\Models;
use App\Models\Unit;
use App\Models\product_unit;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'name'
    ];

    protected $hidden = ["created_at","updated_at"];

    protected $appends = [
        'total_quantity',
        'image_path',
    ];

    public function units()
    {
        return $this->belongsToMany(Unit::class, product_unit::class)->withPivot("amount");
    }

    public function getTotalQuantityAttribute()
    {
        $sum = 0;
        $units = $this->units;
        foreach($units as $unit){

            $sum += $unit->modifier * $unit->pivot->amount;
        }
        unset($this->units);//delete relationship from response
        return $sum;

    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }


    public function getImagePathAttribute()
    {
        $image=($this->image)?$this->image->path:null;
        unset($this->image);//delete relationship from response
        return $image;
    }

}

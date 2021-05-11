<?php

namespace App\Models;
use App\Models\SubCategory;
use App\Models\ProductImage;
use App\Models\ProductVideo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\Stock;

class Product extends Model
{
    use HasFactory;

    public function subcategory()
    {
        return $this->belongsToMany(SubCategory::class);
    }

    public function image()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function video()
    {
        return $this->hasOne(ProductVideo::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function stock()
    {
        return $this->hasOne(Stock::class);
    }
}

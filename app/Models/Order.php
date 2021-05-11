<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\OrderComplain;
use App\Models\OrderProduct;
class Order extends Model
{
    use HasFactory;
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order_product()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function order_complain()
    {
        return $this->hasMany(OrderComplain::class);
    }
}

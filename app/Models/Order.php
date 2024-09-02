<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['customer_name'];

    public function products()
    {
        return $this->belongsToMany(Produk::class, 'order_product');
    
    }
}

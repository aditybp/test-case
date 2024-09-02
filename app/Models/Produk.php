<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = ['nama_produk', 'deskripsi', 'harga', 'jumlah_stok'];

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_product');
    }
}

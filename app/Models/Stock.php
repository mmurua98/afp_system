<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'warehouse_id',
        'stock'
    ];

    public function product(){
        return $this->belongsTo('App\Models\Product');
    }

    public function warehouse(){
        return $this->belongsTo('App\Models\Warehouse');
    }
}

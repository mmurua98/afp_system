<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovimientoAlmacenDetalle extends Model
{
    use HasFactory;

    protected $fillable = [
        'movimientoalmacen_id',
        'movement_type_id',
        'product_id',
        'warehouse_id',
        'quantity',
        'comment'
    ];

    public function movimientoalmacen(){
        return $this->belongsTo('App\Models\MovimientoAlmacen');
    }

    public function movementtype(){
        return $this->belongsTo('App\Models\MovementType');
    }

    public function product(){
        return $this->belongsTo('App\Models\Product');
    }

    public function warehouse(){
        return $this->belongsTo('App\Models\Warehouse');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovimientoAlmacen extends Model
{
    use HasFactory;

    protected $fillable = [
        'movement_type_id',
        'user_id',
        'date',
        'comment',
        'folio',
        'order_id',
        'salida_id'
    ];

    public function movementtype(){
        return $this->belongsTo('App\Models\MovementType');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}

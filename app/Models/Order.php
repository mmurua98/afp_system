<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'po_number',
        'date',
        'supplier_id',
        'total',
        'description',
        'serie',
        'folio',
        'require_employee_id'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function supplier(){
        return $this->belongsTo('App\Models\Supplier');
    }

    public function tiposiva(){
        return $this->hasMany('App\Models\TiposIva');
    }

    public function requireemployee(){
        return $this->belongsTo('App\Models\RequireEmployee');
    }
}

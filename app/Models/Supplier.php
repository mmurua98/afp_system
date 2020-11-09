<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'company',
        'raz_social',
        'phone',
        'location',
        'name',
        'last_name',
        'email',
        'tipoiva_id'
    ];

    public function tipoiva(){
        return $this->belongsTo('App\Models\TiposIva');
    }
}

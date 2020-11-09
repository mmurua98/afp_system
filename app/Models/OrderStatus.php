<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    public $table = "orderstatus";
    use HasFactory;

    protected $fillable = [
        'name'
    ];
}

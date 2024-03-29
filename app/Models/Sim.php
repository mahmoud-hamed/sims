<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sim extends Model
{
    use HasFactory;
    protected $guarded= [];

    public function order(){
        return $this->hasMany(OrderItem::class,'sim_id');
    }
}

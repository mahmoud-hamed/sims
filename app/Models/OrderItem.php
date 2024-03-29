<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $table = 'order_item';
    public $timestamps = true;
    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }



    public function sim()
    {
        return $this->belongsTo('App\Models\Sim' , 'sim_id','id');
    }

}

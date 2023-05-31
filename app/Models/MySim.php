<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MySim extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'my_sim';

    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }



    public function sim()
    {
        return $this->belongsTo('App\Models\Sim' , 'sim_id','id');
    }

}

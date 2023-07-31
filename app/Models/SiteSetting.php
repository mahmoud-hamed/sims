<?php

namespace App\Models;

use App\Traits\GetAttribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SiteSetting extends Model
{
    use HasFactory ,GetAttribute;

    protected $guarded = [];


    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->multiple_attachment = true;
        $this->multiple_attachment_usage = ['default', 'bdf-file'];
    }
    public function getFullNameAttribute()
    {
        return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
    }

}

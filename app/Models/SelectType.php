<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelectType extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    protected $hidden=['pivot'];

    protected $table='select_types';

    public function Services()
    {
        return $this->belongsToMany('App\Models\Serivce','selecttype_service','selecttype_id','service_id');
    }
}

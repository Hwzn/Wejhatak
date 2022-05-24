<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tripagent extends Model
{
    use HasFactory;
    protected $table='trip_agents';
    protected $guarded=['id'];
    protected $hidden=['pivot'];

    public function Services()
    {
      return $this->belongsToMany('App\Models\Serivce','tripagent_service','tripagent_id','service_id');
    }
}

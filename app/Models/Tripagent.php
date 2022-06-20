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

    public function Users()
    {
      return $this->belongsToMany('App\Models\User','faviourt_tripagents','tripagent_id','service_id');
    }

    public function Packages()
    {
      return $this->belongsToMany('App\Models\Package','tripagent_package','tripagent_id','package_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Tripagent extends Authenticatable implements JWTSubject
{
    use HasFactory;
    protected $table='trip_agents';
    protected $fillable = [
      'name',
      'phone',
      'password',
      'verified_at',
      'photo',
      'profile_photo',
      'type',
      'address',
      'Agency_id',
      'Commercial_RegistrationNo',
      'CommercialRegistration_ExpiryDate',
      'license_number',
      'license_expiry_date',
      'Countries',
      'status',

  ];
    protected $hidden=['pivot'];


    public function getJWTIdentifier() {
      return $this->getKey();
  }

  
  public function getJWTCustomClaims() {
      return [];
  }    

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

    public function DeviceTokens()
    {
        return $this->hasMany('App\Models\DeviceToken');
    }

    // public function Notifications()
    // {
    //     return $this->belongsToMany('App\Models\UserNotification','user_notifications');
    // }
}

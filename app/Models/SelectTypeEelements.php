<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelectTypeEelements extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    protected $table='selecttype_elements';
}

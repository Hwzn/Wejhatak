<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class AgencyType extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $guarded=['id'];
    protected $table='agency_types';
    public $translatable = ['name'];

    public function asJson($value)
    {
        return json_encode($value,JSON_UNESCAPED_UNICODE);
    }

}

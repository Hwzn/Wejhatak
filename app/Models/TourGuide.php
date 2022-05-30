<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class TourGuide extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['name','desc'];
    public function asJson($value)
    {
        return json_encode($value,JSON_UNESCAPED_UNICODE);
    }

}

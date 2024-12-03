<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Governorate extends Model
{
    use HasTranslations;
    public $translatable = ['name'];
    protected $fillable = ['name' , 'country_id'];
    public $timestamps = false;
    
}

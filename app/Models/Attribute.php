<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Attribute extends Model
{
    use HasTranslations ;

    protected $table = 'attributes';
    protected $fillable = ['id' , 'name' , 'created_at' , 'updated_at'];
    protected $translatable = ['name'];

    public function getCreatedAtAttribute($value){
        return date('d/m/y H:i a' , strtotime($value));
    }

    // relationship with attribute values
    public function attributeValues()
    {
        return $this->hasMany(AttributeValue::class);
    }
}

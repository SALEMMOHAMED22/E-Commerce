<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Role extends Model
{
    use HasTranslations;
    public $translatable = ['role'];
    protected $fillable = [
        'role',
        'permission',
    ];


    public function getPermissionAttribute($value)
    {
        return json_decode($value);
    }


    public function admins()
    {
        return $this->hasMany(Admin::class, 'role_id');
    }
}

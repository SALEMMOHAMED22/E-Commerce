<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaqQuestion extends Model
{
    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
    ];

    public function getCreatedAtAttribute($value)
    {
        return \Carbon\carbon::parse($value)->format('d-m-Y H:i a');
    }
}

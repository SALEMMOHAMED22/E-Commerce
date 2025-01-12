<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class Faq extends Model
{
    use HasTranslations , HasFactory;

    public $translatable = ['question', 'answer'];

    protected $fillable = [ 'id','question', 'answer'];
    public $timestamps = false;
}

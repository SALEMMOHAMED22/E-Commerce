<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Page extends Model
{
    use  HasTranslations;
    protected $table = 'pages';

    protected $fillable = ['title', 'slug', 'content', 'image'];
    protected $translatable = ['title', 'content'];

    // public function sluggable(): array
    // {
    //     return [
    //         'slug' => [
    //             'source' => 'title'
    //         ]
    //     ];
    // }

    public function getCreatedAtAttribute(){
        return date('d/m/y h:i a' , strtotime($this->attributes['created_at']));
    }

    // public function getImageAttribute($value){
    //     return asset('uploads/pages'.$value);
    // }


}

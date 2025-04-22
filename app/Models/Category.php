<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Config;

class Category extends Model
{
    use  Sluggable , HasTranslations;

    protected $translatable = ['name'];
    protected $table = 'categories';
    protected $fillable = [
        'name',
        'status',
        'slug',
        'parent',
        'icon',
    ];




    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

  
    public function getStatusTranslated(){
        if(Config::get('app.locale' == 'ar')){
            return $this->status == 1 ? 'مفعل' : 'غير مفعل';
        }else{
            return $this->status == 1 ?  'Active' : 'Inactive';
        }

    }
    public function scopeActive($query){
        return $query->where('status' , 1);
    }
    public function scopeInactive($query){
        return $query->where('status' , 0);
    }

    public function getCreatedAtAttribute($value){
        return date('d/m/y h:i A' , strtotime($value));
    }
 
    public function products(){
        return $this->hasMany(Product::class , 'category_id');
    }

    public function children(){
        return $this->hasMany(Category::class , 'parent');
    }
    public function parent(){
        return $this->belongsTo(Category::class , 'parent');
    }

    public function getIconAttribute($icon){
        return 'uploads/categories/' . $icon;
    }
}   

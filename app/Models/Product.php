<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Config;

class Product extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['name', 'desc', 'small_desc'];
    public $guarded = [];

    // relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function productPreviews()
    {
        return $this->hasMany(ProductPreview::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tags', 'product_id', 'tag_id');
    }
    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function isSimple()
    {
        return !$this->has_variants;
    }

    // accessores

    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y H:i a', strtotime($value));
    }

    public function getUpdatedAtAttribute($value)
    {
        return date('d/m/Y H:i a', strtotime($value));
    }
    public function hasVariantsTranslated(){
      
        return $this->has_variants == 1 ? __('dashboard.has_variants') : __('dashboard.no_variants');
    }
    public function getStatusTranslated(){
      

            return $this->status == 1 ? __('dashboard.active') : __('dashboard.inactive');
        
    }

    public function priceAttribute(){
        return $this->has_variants == 0 ? number_format($this->price) : __('dashboard.has_variants');
    }
    public function quantityAttribute(){
        return $this->has_variants == 0 ? $this->quantity : __('dashboard.has_variants');
    }
    

}

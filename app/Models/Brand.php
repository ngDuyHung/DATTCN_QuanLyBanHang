<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands';
    protected $primaryKey = 'brand_id';
    protected $fillable = ['name','slug', 'logo_url', 'description', 'is_staff', 'category_id'];
    public $timestamps = true;

 
    protected $casts = [
        'is_active' => 'boolean',
    ];
    public function products()
    {
        return $this->hasMany(Product::class, 'brand_id', 'brand_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }
}

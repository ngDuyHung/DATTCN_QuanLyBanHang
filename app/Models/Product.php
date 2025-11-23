<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //product_id	sku	name	short_description	description	price	cost_price	weight	is_active	category_id	brand_id	created_at	updated_at
    protected $table = 'products';
    protected $primaryKey = 'product_id';
    protected $fillable = ['sku', 'name', 'short_description', 'description', 'sale_description', 'price', 'cost_price', 'weight', 'is_active','main_img_url', 'category_id', 'brand_id','total_attributes'];
    public $timestamps = true;


    public function images()
    {
        return $this->hasMany(Product_image::class, 'product_id', 'product_id');
    }

    public function attributes()
    {
        return $this->hasMany(Product_attribute::class, 'product_id', 'product_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'brand_id');
    }

    public function getPriceFormatAttribute()
    {
        return number_format($this->price, 0, ',', '.') ;
    }

    public function getCostPriceFormatAttribute()
    {
        return number_format($this->cost_price, 0, ',', '.') ;
    }

    //hàm tính chiết khấu % giảm giá 
    public function getDiscountPercentAttribute()
    {
        if ($this->cost_price > 0 && $this->price < $this->cost_price) {
            $discount = (($this->cost_price - $this->price) / $this->cost_price) * 100;
            return round($discount);
        }
        return 0;
    }
}
